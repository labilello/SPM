<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Makepc;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MakePccontroller extends Controller
{

    public function action(Request $request, Makepc $makepc = null) {
        $data = $request->get('data');

        $record = array(
            'NV' => $request->get('NV', '000000000'),
            'parts' => $data,
            'user_id' => Auth::id()
        );

        if($makepc == null) {
            $makepc = new Makepc( $record );
            $makepc->save();
        } else {
            $makepc->update( $record );
        }

        return redirect(route('vista.makepc.editar', $makepc))->with([
            'type_status' => 'success',
            'status' => "Se han registrado los numeros de serie correctamente bajo el numero interno: " . $makepc->id
        ]);
    }

    public function imprimirEtiqueta(Makepc $makepc) {

        $arrays = array_chunk($makepc->parts, 8);
        foreach ($arrays as $parts) {
            try
            {
                $zpl = $this->crearEtiqueta($makepc->id, $makepc->NV, $parts);
                //abrimos el soket de red a la ip de la impresora y el puerto por defecto de zebra es el 9100
                $printerIp ="192.168.1.50";
                $fp = pfsockopen($printerIp,9100);
                fputs($fp, $zpl);
                fclose($fp);
            }
            catch (Exception $e) {
                return back()->with([
                    'type_status' => 'danger',
                    'status' => $e->getMessage()
                ]);
            }
        }

        return back()->with([
            'type_status' => 'success',
            'status' => "Se han enviado " . count($arrays)  . " etiquetas a la cola de impresión!"
        ]);
    }

    private function crearEtiqueta($id, $nv, $parts) {
        $init ="CT~~CD,~CC^~CT~
                ^XA
                ~TA000
                ~JSN
                ^LT0
                ^MNW
                ^MTT
                ^PON
                ^PMN
                ^LH0,0
                ^JMA
                ^PR8,8
                ~SD15
                ^JUS
                ^LRN
                ^CI27
                ^PA0,1,1,0
                ^MMT
                ^PW799
                ^LL480
                ^LS0\n";

        // HEADER
        $header = "^FT88,204^A0B,17,18^FH\^CI28^FDNV/Carrito:^FS^CI27
                ^FT88,123^A0B,17,18^FB94,1,4,R^FH\^CI28^FD$nv^FS^CI27
                ^FO14,268^GFA,657,2304,12,:Z64:eJy9lTFugzAUhp8roUiR2GpliaUoo/fs5AYZQFmSO2SAve2EOEXEZHEKcoOOHcxdCpTn9yiQJmpaE2V4+vXr4/dv40XdCgB00S0DoKpuffTnCa64Pz+i3gIUbL6Puifsz6f03P8WPeJHf+R/lf9IepORfwDkn69J36ba6VPj+EOx8xy/rp9Ob5X1UF+rM/Q/ycRj/Dnpq6G+IV9EM+Q3upg7vU/+RWacfyx20vmvVnqcP6X8A8Hy1z/mH8eUj9Hk/34gf2NSxx+E4PjPhX5CfWmV46/jdPzbWAr0z412+VysuqA+Q31NLkK5Rf639tfpq+rV+bP8gyRx/ueiWDsevl+YZ82/E8HC9Wf9RPuL/zzPtj/izv4L6fLP17RfJfjkz/rvsf5r8rdqvP91f6j/XH+c2N/NDf4Z4/fY+c1JD0D8aZpS/gDyrvM7C/n5pXx8q5g+Y/yj/vX7+gN9Q96+wUg+qhr1T2TM/YnnpRz2oeEPBOPX19/3+/1mmL5cVoM+tPk/U3+0djx2uZzIRxK/Jn97UMN82v5I6r/Wc8qH+WMf2n6eNnR/GsbPzgvet03+zfU5lv9UP5OJfo7pG34p9xPn1/+1/1d/7uJ/3PfrAf7/+f3VE3o+36D/ic3PAB7qS+itT0VVWOE=:99E3
                ^BY2,3,44^FT65,227^B2B,,N,N
                ^FH\^FD$id^FS
                ^FO105,14^GB0,453,4^FS\n";

        $zpl = $init . $header;

        for ($i = 0; $i < count($parts); $i++) {
            $yBarras = 164 + (83 * $i);
            $yDetalle = $yBarras + 17;
            $zpl .= "^BY2,3,43^FT{$yBarras},460^BCB,,N,N
                    ^FH\^FD{$parts[$i]['serie']}^FS
                    ^FO774,14^GB0,453,4^FS
                    ^FT{$yDetalle},460^A0B,17,18^FH\^CI28^FD{$parts[$i]['part']}: {$parts[$i]['serie']}^FS^CI27\n";
        }
        $zpl .="^XZ";
        return $zpl;

    }
}
