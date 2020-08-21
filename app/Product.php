<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Product extends Model
{
    protected $primaryKey = 'codigo_unix';
    protected $fillable = ['codigo_unix', 'codigo_unico', 'descripcion', 'marca','familia', 'codigo_barras'];
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
                $data[] = [
                    'codigo_unix' => ($row[6] == 0 || $row[6] == '') ? $row[0] : $row[6],
                    'descripcion' => $row[1],
                    'marca' => $row[2],
                    'familia' => $row[3],
                    'codigo_barras' => $row[4],
                    'codigo_unico' => $row[5],
                ];
                $i++;

                if($i >= 1000) {
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
