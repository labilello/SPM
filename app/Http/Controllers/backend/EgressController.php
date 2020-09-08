<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Shipment;
use Illuminate\Http\Request;

class EgressController extends Controller
{
    public function nuevo(Request $request){
        $shipment = new Shipment([
            'name' => $request->input('name'),
            'shipto' => $request->input('shipto'),
        ]);

        try {
            $shipment->save();
            return redirect(route('vista.egresos.envio', $shipment));
        } catch (\Illuminate\Database\QueryException $exception) {
            return back()->with([
                'status' => 'Error al crear el nuevo envío. Reintente nuevamente o consulte con un administrador!',
                'type_status' => 'danger'
            ]);
        }


    }
}
