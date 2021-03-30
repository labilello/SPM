<?php

namespace App\Http\Controllers\backend\API;

use App\Http\Controllers\Controller;
use App\Movement;
use App\Repair;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

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
