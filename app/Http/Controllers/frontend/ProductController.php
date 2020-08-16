<?php


namespace App\Http\Controllers\frontend;


use App\Http\Controllers\Controller;
use App\Product;

class ProductController extends Controller
{
    public function index() {

        return view('reportes\productos', [
            'products' => Product::paginate()
        ]);
    }

}
