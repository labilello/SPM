<?php

namespace App\Http\Controllers\backend\API;

use App\Http\Controllers\Controller;
use App\Movement;
use App\Repair;
use App\Shipment;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EgressController extends Controller
{
    public function addToShipment(Request $request, Shipment $shipment){

        if($shipment->is_closed)
            return response([
                'response' => 'error',
                'message' => 'Envío ya cerrado'
            ], 200, ['Content-Type: application/json']);

        $repair = Repair::where('nro_serie', '=', $request->get('nro_serie'))
            ->where('status_id', '=', '2')
            ->first();

        $user = User::find($request->get('user_id'));

        if(!$repair || !$user)
            return response([
                'response' => 'error',
                'message' => 'Los datos enviados son incorrectos. Verifique e intente nuevamente.'
            ], 200, ['Content-Type: application/json']);

        $repair->shipment_id = $shipment->id;
        $repair->date_out = now();
        $repair->status_id = Status::where('descripcion', 'Egresado')->get()->first()->id;

        /* TABLA MOVIMIENTOS */
        $movimiento = new Movement();
        $movimiento->user_id = $user->id;
        $movimiento->repair_id = $repair->id;
        $movimiento->status_id = $repair->status_id;

        $movimiento->save();
        $repair->save();

        return response([
            'response' => 'ok',
            'repair' => [
                'producto' => $repair->product->descripcion,
                'nro_serie' => $repair->nro_serie,
                'is_repair' => $repair->is_repair,
            ]
        ], 200, ['Content-Type: application/json']);

    }
}
