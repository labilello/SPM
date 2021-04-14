<?php

namespace App\Http\Livewire\Tables;

use App\Exports\MyDatatableExport;
use App\Http\Traits\SweetAlertLive;
use App\Repair;
use App\Status;
use Maatwebsite\Excel\Facades\Excel;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class EgresosPendientesTable extends LivewireDatatable
{
    use SweetAlertLive;
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

            Column::name('id')->label('#')->filterable()->alignCenter(),

            Column::name('product.descripcion')->label('Producto')->searchable()->filterable(),

            DateColumn::name('date_in')->label('Fecha de Ingreso')->filterable()->format("d/m/Y H:i:s"),

            Column::name('product.familia')->label('Familia')->searchable()->filterable(),

            Column::name('nro_serie')->label('Nro. Serie')->searchable()->filterable()->editable(),

            Column::callback(['id'], function ($id) {
                return view('egresos.reparacionespendientes-table-actions', ['id' => $id]);
            })->label('Acciones'),

        ];
    }

    public function delete( $id ) {
        $repair = Repair::findOrFail( $id );
        foreach ($repair->movements as $movement) {
            $movement->delete();
        }
        $repair->delete();
    }

    public function edited($value, $table, $column, $rowId)
    {
        if( $column != 'nro_serie' ) {
            $this->emit('fieldEdited', $rowId);
            return;
        }

        $repair = Repair::findOrFail( $rowId );
        $repairsWithSameValue = Repair::where('nro_serie', $value)->where('status_id', '<>', 3)->get();

        if( $repairsWithSameValue->count() > 0 ) {
            $this->crearAlerta('No se ha podido actualizar debido a que ya existe una reparacion en progreso con ese mismo numero de serie.',
                'Imposible modificar',
                'error')
                ->toast()
                ->getDataToDispatch();
            return;
        }

        $repair->nro_serie = $value;
        $repair->save();

        $this->emit('fieldEdited', $rowId);
    }

    public function export()
    {
        $this->forgetComputed();
        return Excel::download(new MyDatatableExport($this->getQuery()->get(), $this->columns), 'Lista de Reparaciones Pendientes de Egreso.xlsx');
    }
}
