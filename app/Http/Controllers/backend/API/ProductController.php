<?php

namespace App\Http\Controllers\backend\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getByEan($codigo_ean)
    {
        $result = Product::where('codigo_barras', 'LIKE', "%$codigo_ean%")->get();

        if($result->count() === 0) {
            return response("", 404, ['Content-Type: application/json']);
        }

        return response($result, 200, ['Content-Type: application/json']);
    }


}
