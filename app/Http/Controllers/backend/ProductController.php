<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductsTableCSV;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function eanGet($codigo_ean)
    {
        $result = Product::where('codigo_barras', 'LIKE', "%$codigo_ean%")->get();

        if($result->count() === 0) {
            return response("", 404, ['Content-Type: application/json']);
        }

        return response($result, 200, ['Content-Type: application/json']);
    }


    public function updateBaseStock(Request $request) {

        $file = $request->file('archivo');
        $fileName = 'basestock.csv';

        $file->move('uploads', $fileName);

        $res = Product::importCsv(public_path('uploads/' . $fileName));

//        return back()->with([
//            'type_status' => $res === true ? 'success' : 'danger',
//            'status' => $res === true ? 'Se insertaron correctamente los productos nuevos en la base de datos' : 'Error la insertar los productos nuevos en la base de datos'
//        ]);
        return back()->with([
            'type_status' => 'danger',
            'status' => "Ya existe una reparacion en curso para este numero de serie. Producto no ingresado"
        ]);


    }

}
