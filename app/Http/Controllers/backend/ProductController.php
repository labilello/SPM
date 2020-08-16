<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class productController extends Controller
{

    public function eanGet($codigo_ean)
    {
        $result = Product::where('codigo_barras', 'LIKE', "%$codigo_ean%")->get();

        if($result->count() === 0) {
            return response("", 404, ['Content-Type: application/json']);
        }

        return response($result, 200, ['Content-Type: application/json']);
    }


}
