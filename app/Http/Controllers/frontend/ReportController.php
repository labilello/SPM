<?php


namespace App\Http\Controllers\frontend;


use App\Http\Controllers\Controller;
use App\Repair;

class ReportController extends Controller
{
    public function reparaciones(){
        return view('reportes\reparaciones', [
            'elements' => Repair::paginate()
        ]);
    }

    public function porcel() {
        // SELECT `repairs`.`product_id`, `products`.`descripcion`, `products`.`familia`, `repairs`.`is_repair`, COUNT(*) as TOTAL FROM `repairs` INNER JOIN `products` ON `products`.`codigo_unix`=`repairs`.`product_id` WHERE `status_id` = 2 GROUP BY `repairs`.`product_id`, `repairs`.`is_repair`
        //
        //--

    }
}
