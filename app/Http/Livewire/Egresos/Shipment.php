<?php

namespace App\Http\Livewire\Egresos;

use App\Exports\ShipRepairsExport;
use App\Http\Traits\SweetAlertLive;
use App\Movement;
use App\Repair;
use App\Status;
use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use App\Shipment as ShipmentModel;
use Maatwebsite\Excel\Excel;
use Mediconesystems\LivewireDatatables\Exports\DatatableExport;
use UxWeb\SweetAlert\SweetAlert;


class Shipment extends Component
{
    use SweetAlertLive;
    public $repairs;
    public $shipment;

    public function mount(ShipmentModel $shipment) {
        $this->shipment = $shipment;
        $this->repairs = $shipment->repairs;
    }

    public function render()
    {
        return view('livewire.egresos.shipment')
            ->extends('layouts.layout')
            ->section('content');
    }

    public function cancelShipProduct ($id) {
        if( $this->shipment->is_closed )
            return;

        try {
            $repair = Repair::find( $id );
            $repair->shipment_id = null;
            $repair->status_id = $repair->status_id - 1;
            $repair->date_out = null;
            $repair->save();

            Movement::where('repair_id', $repair->id)
                ->where('status_id', Status::where('descripcion', 'Egresado')->get()->first()->id)->delete();

            self::removerReparacion( $repair->id );
        } catch (\Exception $e) {
            dd('Dont work');
        }
    }

    public function removerReparacion( $id ) {
        if( $this->shipment->is_closed )
            return;

        $this->repairs = ($this->repairs->filter(function($item) use($id) {
            return $item->id != $id;
        }))->values();
    }

    public function cancelAllShipment () {
        if( $this->shipment->is_closed )
            return;

        foreach ($this->repairs as $repair)
            $this->cancelShipProduct( $repair->id );

        if( $this->shipment->delete() ) {
            alert()->success('Remito eliminado con exito. Todas las reparaciones fueron devueltas a su estado anterios', 'Remito eliminado');
            return Redirect::route('vista.egresos.index');
        } else
            $this->crearAlerta('No se ha podido eliminar el remito. Reintente nuevamente recargando la pagina o consulta con el administrador.',
                'Imposible eliminar remito',
                'error')
                ->toast()
                ->getDataToDispatch();

    }

    public function addProduct( $nroSerie ) {
        if( $this->shipment->is_closed )
            return;

        $repair = Repair::where('nro_serie', $nroSerie)->whereHas('status', function (Builder $query){
            $query->where('descripcion', 'Reparado');
        })->first();

        if(! $repair)
            $this->crearAlerta('Revise que la reparación para el numero de serie ingresado ya se encuentre reparada',
                'No se ha encontrado una reparacion para despachar con el numero de serie indicado',
                'error')
                ->toast()
                ->getDataToDispatch();
        else {
            $repair->shipment_id = $this->shipment->id;
            $repair->date_out = now();
            $repair->status_id = Status::where('descripcion', 'Egresado')->get()->first()->id;

            /* TABLA MOVIMIENTOS */
            $movimiento = new Movement();
            $movimiento->user_id = Auth::user()->id;
            $movimiento->repair_id = $repair->id;
            $movimiento->status_id = $repair->status_id;

            $movimiento->save();
            $repair->save();

            $this->repairs->push( $repair );
            $this->crearAlerta('',
                'Elemento agregado al remito',
                'success')
                ->toast()
                ->getDataToDispatch();
        }
    }

    public function downloadPDF() {
        $pdf = PDF::loadView('egresos.PDFremito', ['shipment' => $this->shipment] );
        return $pdf->download($this->shipment->name . '-remito.pdf');
    }

    public function downloadExcel() {
        return \Maatwebsite\Excel\Facades\Excel::download(new ShipRepairsExport($this->shipment), $this->shipment->name . '-envio.xlsx' );
    }

}
