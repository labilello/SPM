<?php

namespace App\Http\Livewire\Tables;

use App\Exports\MyDatatableExport;
use App\Movement;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
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
            Column::name('id')->label('#')->filterable()->alignCenter(),
            Column::name('status.descripcion')->label('Tipo de Movimiento')->searchable()->filterable(['Ingresado', 'Reparado', 'Egresado'])->alignCenter(),
            DateColumn::name('created_at')->label('Fecha')->filterable()->format("d/m/Y H:i:s"),
            Column::name('repair.product.descripcion')->label('Producto')->filterable(),
            Column::name('repair.nro_serie')->label('Nro. Serie')->filterable()->searchable(),
            Column::name('repair.product.familia')->label('Familia')->searchable()->filterable(),
            NumberColumn::name('repair.id')->label('# Reparacion')->filterable()->alignCenter(),
            Column::name('user.name')->label('Usuario')->filterable(),
        ];
    }

    public function export()
    {
        $this->forgetComputed();
        return Excel::download(new MyDatatableExport($this->getQuery()->get(), $this->columns), 'Historial de Movimientos.xlsx');
    }
}
