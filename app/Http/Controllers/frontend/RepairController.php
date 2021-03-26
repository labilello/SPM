<?php

namespace App\Http\Controllers\frontend;

use App\DataTables\PendingRepairsDataTable;
use App\Http\Controllers\Controller;
use App\Repair;
use App\Status;

class RepairController extends Controller
{
    public function nuevo()
    {
        return view('reparaciones\nuevo');
    }

    public function pendientes()
    {
        return view('reparaciones/pendientes');
    }

    public function reparar(Repair $repair)
    {
        if($repair->status->id > 1)
            return back()->with([
                'type_status' => 'danger',
                'status' => "La reparacion que intenta reparar se encuentra en estado \"{$repair->status->descripcion}\""
            ]);

        return view('reparaciones\reparar', [
            'element' => $repair,
        ]);
    }
}
