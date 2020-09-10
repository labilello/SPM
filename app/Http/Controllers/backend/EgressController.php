<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Shipment;
use Carbon\Carbon;
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

    public function cerrarShipment(Request $request, Shipment $shipment) {
        $shipment->is_closed = true;
        $shipment->nro_interno = $request->input('nro_interno');
        $shipment->save();

        return back()->with([
            'status' => "Remito grabado correctamente. Imprima 3 hojas del mismo en caso de ser necesario!",
            'type_status' => 'success'
        ]);;

    }

    public function filtro(Request $request) {

        $remito = $request->input('remito_nro');
        $nro_interno = $request->input('nro_interno');
        $fechaDesde = $request->input('fechas.since');
        $fechaHasta = $request->input('fechas.to');
        $vistaRetorno = $request->input('viewreturn');

        $remito = isset($remito) ? "%$remito%" : '%%';
        $nro_interno = isset($nro_interno) ? "%$nro_interno%" : '%%';
        $fechaDesde = isset($fechaDesde) ? $fechaDesde : '2020-01-01 00:00:00';
        $fechaHasta = isset($fechaHasta) ? $fechaHasta : Carbon::now('America/Argentina/Buenos_Aires')->toDateTimeString();

        $elements = Shipment::where('is_closed', '=', 1)
            ->where('name', 'like', $remito)
            ->where('nro_interno', 'like', $nro_interno)
            ->whereBetween('updated_at', [$fechaDesde, $fechaHasta])
            ->orderBy('updated_at', 'desc')
            ->get();


        return view($vistaRetorno, [
            'elements' => $elements
        ]);
    }
}
