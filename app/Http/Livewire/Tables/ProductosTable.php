<?php

namespace App\Http\Livewire\Tables;

use App\Product;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class ProductosTable extends LivewireDatatable
{
    public $hideable = 'select';
    public $exportable = true;

    public function builder()
    {
        return Product::query();
    }

    public function columns()
    {
        return [

            Column::name('id')->label('Cod. Unix')->filterable(),
            Column::name('descripcion')->label('Producto')->searchable()->filterable(),
            Column::name('marca')->label('Marca')->searchable()->filterable(),
            Column::name('familia')->label('Familia')->searchable()->filterable(),
            Column::name('codigo_barras')->label('Cod. Barras')->searchable()->filterable()->editable(),
            Column::name('codigo_unico')->label('Cod. Unico')->filterable(),

//            Column::callback(['id'], function ($id) {
//                return view('reparaciones.table-actions', ['id' => $id]);
//            })->label('Acciones'),

        ];
    }
}
