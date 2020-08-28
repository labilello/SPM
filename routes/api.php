<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('productos/ean/{ean}', 'backend\API\ProductController@getByEan');
Route::get('reparaciones/{status}/nroserie/{nroserie?}', 'backend\API\RepairController@getByStatusSerie');


Route::post('productos', 'backend\ProductController@updateBaseStock')->name('api.updateBaseStock');


//Route::apiResource('/products/out', 'Products\ProductsOutController');
//Route::apiResource('/products/in', 'Products\ProductsInController');

