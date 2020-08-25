<?php


namespace App\Http\Controllers\frontend;


use App\Http\Controllers\Controller;
use App\Repair;
use App\Status;

class EgressController extends Controller
{
    public function nuevo()
    {
        return view('egresos\nuevo');
    }

    public function pendientes()
    {
        return view('egresos\pendientes', [
            'elements' => Repair::where('status_id', Status::where('descripcion', 'Reparado')->get()->first()->id)->orderBy('date_in')->paginate()
        ]);
    }
}
