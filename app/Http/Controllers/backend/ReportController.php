<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Movement;
use App\Repair;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function movementsAgruped(Request $request) {

        $tipoMovimiento = $request->input('type_movement');
        $fechaDesde = $request->input('fechas.since');
        $fechaHasta = $request->input('fechas.to');

        $tipoMovimiento = isset($tipoMovimiento) ? $tipoMovimiento : '%%';
        $fechaDesde = isset($fechaDesde) ? $fechaDesde : Carbon::now('America/Argentina/Buenos_Aires')->subDays(30)->toDateTimeString();
        $fechaHasta = isset($fechaHasta) ? $fechaHasta : Carbon::now('America/Argentina/Buenos_Aires')->toDateTimeString();

        $producto = $request->input('producto');
        $producto = isset($producto) ? "%$producto%" : '%%';

        $familia = $request->input('familia');
        $familia = isset($familia) ? "%$familia%" : '%%';

        $elements = Movement::where('movements.status_id', 'like', $tipoMovimiento)
            ->whereBetween('movements.created_at', [$fechaDesde, $fechaHasta])
            ->where('products.descripcion', 'like', $producto)
            ->where('products.familia', 'like', $familia)
            ->select('movements.status_id', 'repairs.product_id', 'products.descripcion', 'products.familia', DB::raw('COUNT(*) as total'))
            ->join('repairs', 'repairs.id', 'movements.repair_id')
            ->join('products', 'products.id', 'repairs.product_id')
            ->groupBy('repairs.product_id')
            ->orderBy('products.familia', 'asc')
            ->orderBy('products.id', 'asc')
            ->get();

        return (new \App\Http\Controllers\frontend\ReportController())->index('reportes.movementsAgruped', $elements);
    }

    public function reparacionesAgruped(Request $request) {
        // SELECT `repairs`.`product_id`, `products`.`descripcion`, `products`.`familia`, `repairs`.`is_repair`, COUNT(*) as TOTAL FROM `repairs` INNER JOIN `products` ON `products`.`codigo_unix`=`repairs`.`product_id` WHERE `status_id` = 2 GROUP BY `repairs`.`product_id`, `repairs`.`is_repair`

        $tipoMovimiento = $request->input('type_movement');
        $tipoMovimiento = isset($tipoMovimiento) ? $tipoMovimiento : '%%';

        $producto = $request->input('producto');
        $producto = isset($producto) ? "%$producto%" : '%%';

        $familia = $request->input('familia');
        $familia = isset($familia) ? "%$familia%" : '%%';

        $elements = Repair::select('repairs.status_id', 'repairs.product_id', 'products.descripcion', 'products.familia', 'repairs.is_repair', DB::raw('COUNT(*) as total'))
            ->join('products', 'products.id', '=', 'repairs.product_id')
            ->where('status_id', '<>', 3)
            ->where('status_id', 'like', $tipoMovimiento)
            ->where('products.descripcion', 'like', $producto)
            ->where('products.familia', 'like', $familia)
            ->groupBy('repairs.product_id', 'repairs.is_repair')
            ->orderBy('products.familia', 'asc')
            ->orderBy('repairs.product_id', 'asc')
            ->get();

        return (new \App\Http\Controllers\frontend\ReportController())->index('reportes.reparacionesAgruped', $elements);

    }
}
