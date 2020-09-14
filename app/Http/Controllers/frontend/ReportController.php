<?php


namespace App\Http\Controllers\frontend;


use App\Http\Controllers\Controller;
use App\Movement;
use App\Repair;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function reparaciones(){
        return view('reportes\reparaciones', [
            'elements' => Repair::paginate()
        ]);
    }

    public function index($vistaRetorno, $elements) {

        return view($vistaRetorno, [
            'elements' => $elements
        ]);
    }

}
