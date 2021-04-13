<?php

namespace App\Http\Livewire\Tables;

use App\Exports\MyDatatableExport;
use App\Http\Livewire\Reportes\GraficosReparaciones;
use App\Product;
use App\Repair;
use Maatwebsite\Excel\Facades\Excel;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class HistorialReparacionesTable extends LivewireDatatable
{
    public $hideable = 'select';
    public $exportable = true;
    public $afterTableSlot = 'reportes.graficos-reparaciones';

    public function builder()
    {
        return Repair::query()
            ->leftJoin('products', 'products.id', 'repairs.product_id')
            ->leftJoin('status', 'status.id', 'repairs.status_id');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')->label('#'),
            DateColumn::name('date_in')->label('Fecha de Ingreso')->filterable()->format("d/m/Y H:i:s")->defaultSort('asc'),
            DateColumn::name('date_out')->label('Fecha de Egreso')->filterable()->format("d/m/Y H:i:s"),
            Column::name('product.id')->label('Codigo')->filterable(),
            Column::name('product.descripcion')->label('Producto')->searchable()->filterable(),
            Column::name('product.familia')->label('Familia')->searchable()->filterable(),


            Column::name('nro_serie')->label('Nro. Serie')->searchable()->filterable(),
            BooleanColumn::name('is_repair')->label('¿Reparado?')->filterable([
                ['id' => 0, 'name' => 'Irreparable'],
                ['id' => 1, 'name' => 'Reparado'],
            ])->view('reportes.table-isrepair'),

            Column::name('status.descripcion')->label('Estado')->searchable()->filterable(['Ingresado', 'Reparado', 'Egresado'])->alignCenter(),

            Column::callback(['note'], function ($note) {
                return view('reportes.table-note', ['note' => $note]);
            })->label('Nota'),
        ];
    }

    public function export()
    {
        $this->forgetComputed();
        return Excel::download(new MyDatatableExport($this->getQuery()->get(), $this->columns), 'Historial de Reparaciones.xlsx');
    }

    public function getResultsProperty()
    {
        $query = $this->getQuery();
        $this->emit('tableUpdated', $query->get());

        return $this->mapCallbacks(
            $query->paginate($this->perPage)
        );
    }
}
