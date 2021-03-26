<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'codigo_unico', 'descripcion', 'marca','familia', 'codigo_barras'];
    public $timestamps = false;



    public function movements(){
        return $this->hasMany('App\Movement', 'product_id');
    }

    public static function importCsv($filename = '', $delimiter = ',', $has_header = true)
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        if (($handle = fopen($filename, 'r')) !== false)
        {
            if($has_header){
                if(($row = fgetcsv($handle, 1000, $delimiter)) !== false)
                    Log::info('Header removido -- Product CSVToArray');
            }

            $i = 0;
            $data = [];
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                try {
                    $codigo = ($row[6] == 0 || $row[6] == '') ? $row[0] : $row[6];
                    $ean = explode(';', $row[4], 2);
                    if (isset($data[$codigo])) {
                        // Actualizo EANS
                        if (strpos($data[$codigo]['codigo_barras'], $ean[0]) === false && $ean[0] != '')
                            $data[$codigo]['codigo_barras'] .= (';' . $ean[0]);
                        if (strpos($data[$codigo]['codigo_barras'], $row[7]) === false && $row[7] != '')
                            $data[$codigo]['codigo_barras'] .= (';' . $row[7]);
                    } else {
                        $data[$codigo] = [
                            'id' => $codigo,
                            'descripcion' => $row[1],
                            'marca' => $row[2],
                            'familia' => $row[3],
                            'codigo_barras' => ($row[7] != '') ? $ean[0] . ';' . $row[7] : $ean[0],
                            'codigo_unico' => $row[5],
                        ];
                    }
                }
                catch (\ErrorException $e) {
                    Log::error($e->getMessage() . '7: ' . $row[7] );
                }
                $i++;

                if($i >= 5000) {
                    DB::table('products')->insertOrIgnore($data);
                    $i = 0;
                    $data = [];
                }

            }
            fclose($handle);
        }
        return true;
    }
}
