<?php

namespace App\Http\Livewire\Tables;

use App\Exports\MyDatatableExport;
use App\Product;
use App\Shipment;
use Maatwebsite\Excel\Facades\Excel;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class RemitosEnvioTable extends LivewireDatatable
{
    public $hideable = 'select';
    public $exportable = true;

    public function builder()
    {
//        dd(Shipment::query()->get());
        return Shipment::query();
    }

    public function columns()
    {
        return [
            Column::name('id')->label('#')->filterable()->alignCenter(),
            Column::name('name')->label('Remito Nro.')->searchable()->filterable(),
            Column::name('nro_interno')->label('Nro Interno')->searchable()->filterable()->editable(),
            Column::name('shipto')->label('Envio Hacia')->searchable()->filterable()->editable(),
            DateColumn::name('updated_at')->label('Fecha Estimada Despacho')->searchable()->filterable()->format('d/m/Y H:m'),
            BooleanColumn::name('is_closed')->label('Estado')->filterable([
                ['id' => 0, 'name' => 'Abierto'],
                ['id' => 1, 'name' => 'Cerrado'],
            ])->view('egresos.table-isclosed'),
            NumberColumn::name('repairs.id:count')->label('Nro. Productos')->filterable()->alignCenter(),
            Column::callback(['id'], function ($id) {
                return view('egresos.remitos-table-actions', ['id' => $id]);
            })->label('Acciones'),
        ];
    }

    public function delete( $id ) {
        return;
    }

    public function export()
    {
        $this->forgetComputed();
        return Excel::download(new MyDatatableExport($this->getQuery()->get(), $this->columns), 'Lista de Remitos.xlsx');
    }
}
