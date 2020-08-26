<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Repair;
use App\Status;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function nuevo()
    {
        return view('reparaciones\nuevo');
    }

    public function pendientes()
    {
        return view('reparaciones\pendientes', [
            'elements' => Repair::where('status_id', Status::where('descripcion', 'Ingresado')->get()->first()->id)->orderBy('date_in')->paginate()
        ]);
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
