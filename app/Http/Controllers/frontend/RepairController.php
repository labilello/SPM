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
            'repairs' => Repair::where('status_id', Status::where('descripcion', 'Ingresado')->get()->first()->id)->orderBy('date_in')->paginate()
        ]);
    }

    public function reparar($id)
    {
        $repair = Repair::findOrFail($id);

//        if($repair->status_id == Status::where('descripcion', 'Reparado')->get()->first()->id){
//            return redirect('/ingresados');
//        }


        return view('reparaciones\reparar', [
            'repair' => $repair,
        ]);
    }
}
