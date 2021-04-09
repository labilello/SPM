<?php

namespace App\Http\Livewire\Tables;

use App\Repair;
use App\Status;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class EgresosPendientesTable extends LivewireDatatable
{
    public $hideable = 'select';
    public $exportable = true;

    public function builder()
    {
        return Repair::with('product')->with('status')
            ->where('status_id', Status::where('descripcion', 'Reparado')->get()->first()->id);
    }

    public function columns()
    {
        return [

            NumberColumn::name('id')->label('#')->filterable()->alignCenter(),

            Column::name('product.descripcion')->label('Producto')->searchable()->filterable(),

            DateColumn::name('date_in')->label('Fecha de Ingreso')->filterable()->format("d/m/Y H:i:s"),

            Column::name('product.familia')->label('Familia')->searchable()->filterable(),

            Column::name('nro_serie')->label('Nro. Serie')->searchable()->filterable()->editable(),

//            Column::callback(['id'], function ($id) {
//                return view('reparaciones.table-actions', ['id' => $id]);
//            })->label('Acciones'),

        ];
    }

    public function delete( $id ) {
        dd($this->columns);
//        $repair = Repair::findOrFail( $id );
//        dd('works');
//        $repair->delete();
    }
}
