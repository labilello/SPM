<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Movement;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MovementController extends Controller
{
    public function filtro(Request $request) {

        $tipoMovimiento = $request->input('type_movement');
        $fechaDesde = $request->input('fechas.since');
        $fechaHasta = $request->input('fechas.to');
        $vistaRetorno = $request->input('viewreturn');

        $tipoMovimiento = isset($tipoMovimiento) ? $tipoMovimiento : '%%';
        $fechaDesde = isset($fechaDesde) ? $fechaDesde : '2020-01-01';
        $fechaHasta = isset($fechaHasta) ? $fechaHasta : Carbon::now('America/Argentina/Buenos_Aires')->toDateTimeString();


        $elements = Movement::whereJoin('status_id', 'like', $tipoMovimiento)
            ->whereJoin('created_at', '>=', $fechaDesde)
            ->whereJoin('created_at', '<=', $fechaHasta)
            ->orderByJoin('created_at', 'desc')
            ->orderByJoin('repair.product_id', 'desc')
            ->get();
        //where('status_id', 'like', "%$tipoMovimiento%")

        return view($vistaRetorno, [
            'elements' => $elements
        ]);
    }
}
