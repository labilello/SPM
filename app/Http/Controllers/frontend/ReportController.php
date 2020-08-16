<?php


namespace App\Http\Controllers\frontend;


use App\Http\Controllers\Controller;
use App\Repair;

class ReportController extends Controller
{
    public function reparaciones(){
        return view('reportes\reparaciones', [
            'repairs' => Repair::paginate()
        ]);
    }
}
