<?php

namespace App\Http\Livewire\Tables;

use App\Movement;
use App\User;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class HistorialMovimientosTable extends LivewireDatatable
{
    public $hideable = 'select';
    public $exportable = true;
    public $afterTableSlot = 'reportes.graficos-movimientos';

    public function builder()
    {
        return Movement::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('#'),
            Column::name('status.descripcion')->label('Tipo de Movimiento')->searchable()->filterable(['Ingresado', 'Reparado', 'Egresado'])->alignCenter(),
            DateColumn::name('created_at')->label('Fecha')->filterable()->format("d/m/Y H:i:s"),
            Column::name('repair.product.descripcion')->label('Producto'),
            Column::name('repair.nro_serie')->label('Nro. Serie')->filterable()->searchable(),
            Column::name('repair.product.familia')->label('Familia')->searchable()->filterable(),
            Column::name('user.name')->label('Usuario')->filterable(),
        ];
    }
}
