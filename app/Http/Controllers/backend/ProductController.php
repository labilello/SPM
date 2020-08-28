<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductsTableCSV;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function updateBaseStock(Request $request) {

        $file = $request->file('archivo');
        $fileName = 'basestock.csv';

        $mifile = $file->move('uploads', $fileName);

        $res = Product::importCsv($mifile->getLinkTarget());

        return back()->with([
            'type_status' => $res === true ? 'success' : 'danger',
            'status' => $res === true ? 'Se insertaron correctamente los productos nuevos en la base de datos' : 'Error la insertar los productos nuevos en la base de datos'
        ]);
    }

}
