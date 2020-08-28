<?php

namespace App\Http\Controllers\backend\API;

use App\Http\Controllers\Controller;
use App\Repair;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    public function getByStatusSerie($status, $nroserie = '')
    {
        $result = Repair::where([
            ['nro_serie', 'LIKE', "%$nroserie%"],
            $status > 0 ? ['status_id', '=', $status] : ['status_id', 'LIKE', '%%'],
            ])->get()->load('product');

        if($result->count() === 0) {
            return response("", 404, ['Content-Type: application/json']);
        }

        return response($result, 200, ['Content-Type: application/json']);
    }
}
