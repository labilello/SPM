<?php


namespace App\Http\Controllers\frontend;


use App\Http\Controllers\Controller;
use App\Repair;
use App\Shipment;
use App\Status;
use Barryvdh\DomPDF\Facade as PDF;


class EgressController extends Controller
{
    public function index()
    {
        return view('egresos\createShipment', [
            'shipments' => Shipment::closed(false)->get(),
        ]);
    }

    public function shipment(Shipment $shipment)
    {
        return view('egresos\shipment', [
            'shipment' => $shipment,
        ]);
    }

    public function remitoSalida(Shipment $shipment) {
        $pdf = PDF::loadView('egresos.PDFremito', compact('shipment'));
        return $pdf->download('Remito.pdf');
    }


    public function remitosCerrados() {
        return view('egresos\listShipment', [
            'elements' => Shipment::closed(true)->orderBy('updated_at', 'desc')->paginate(),
        ]);
    }


    public function pendientes()
    {
        return view('egresos\pendientes', [
            'elements' => Repair::where('status_id', Status::where('descripcion', 'Reparado')->get()->first()->id)->orderBy('date_in')->paginate()
        ]);
    }

}
