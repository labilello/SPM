<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// =============== FRONTEND ===================
Route::get('/', 'frontend\HomeController@index')
    ->name('home');

//           *********************          //

Route::get('/movimientos', 'frontend\MovementController@index')
    ->middleware('auth')
    ->name('vista.reportes.movimientos');

Route::get('/productos', 'frontend\ProductController@index')
    ->middleware('auth')
    ->name('vista.reportes.productos');
Route::get('reportes/reparaciones', 'frontend\ReportController@reparaciones')
    ->middleware('auth')
    ->name('vista.reportes.reparaciones');

//           *********************          //

Route::get('/reparaciones/nuevo', 'frontend\RepairController@nuevo')
    ->middleware('auth')
    ->name('vista.reparaciones.nuevo');

Route::get('/reparaciones/pendientes', 'frontend\RepairController@pendientes')
    ->middleware('auth')
    ->name('vista.reparaciones.pendientes');

Route::get('/reparaciones/reparar/{repair}', 'frontend\RepairController@reparar')
    ->middleware('auth')
    ->name('vista.reparaciones.reparar');

//           *********************          //

Route::get('egresos/nuevo', 'frontend\EgressController@nuevo')
    ->middleware('auth')
    ->name('vista.egresos.nuevo');

Route::get('egresos/pendientes', 'frontend\EgressController@pendientes')
    ->middleware('auth')
    ->name('vista.egresos.pendientes');


// =============== BACKEND ===================

Route::post('/reparaciones/pendientes/ingresar', 'backend\RepairController@ingresar')
    ->middleware('auth')
    ->name('accion.reparaciones.ingresar');

Route::patch('/reparaciones/reparar/{repair}', 'backend\RepairController@reparar')
    ->middleware('auth')
    ->name('accion.reparaciones.reparar');

Route::delete('/reparaciones/egresar/{repair}', 'backend\RepairController@egresar')
    ->middleware('auth')
    ->name('accion.reparaciones.egresar');

//           *********************          //
Auth::routes();
