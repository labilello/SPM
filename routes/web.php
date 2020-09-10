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

Route::get('/password/cambiar', 'Auth\ChangePasswordController@index')
    ->middleware('auth')
    ->name('vista.password.cambiar');

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

Route::get('/egresos', 'frontend\EgressController@index')
    ->middleware('auth')
    ->name('vista.egresos.index');

Route::get('/egresos/envio/{shipment}', 'frontend\EgressController@shipment')
    ->middleware('auth')
    ->name('vista.egresos.envio');

Route::get('/egresos/cerrados', 'frontend\EgressController@remitosCerrados')
    ->middleware('auth')
    ->name('vista.egresos.cerrados');


Route::get('/egresos/remito/{shipment}', 'frontend\EgressController@remitoSalida')
    ->middleware('auth')
    ->name('vista.egresos.remito');

Route::get('/egresos/reparaciones/pendientes', 'frontend\EgressController@pendientes')
    ->middleware('auth')
    ->name('vista.egresos.pendientes');


//           *********************          //

Route::get('filtro', 'backend\FilterController@filtroTabla')
    ->middleware('auth')
    ->name('vista.filtro');


// =============== BACKEND ===================

Route::post('/reparaciones/pendientes/ingresar', 'backend\RepairController@ingresar')
    ->middleware('auth')
    ->name('accion.reparaciones.ingresar');

Route::patch('/reparaciones/reparar/{repair}', 'backend\RepairController@reparar')
    ->middleware('auth')
    ->name('accion.reparaciones.reparar');



Route::patch('egresos/envio/{shipment}', 'backend\EgressController@cerrarShipment')
    ->middleware('auth')
    ->name('accion.egresos.cerrar');

Route::post('egresos/nuevo', 'backend\EgressController@nuevo')
    ->middleware('auth')
    ->name('accion.egresos.nuevo');



Route::post('/password/cambiar', 'Auth\ChangePasswordController@changePassword')
    ->middleware('auth')
    ->name('accion.password.change');


/*** FILTROS ***/

Route::post('/movimientos', 'backend\MovementController@filtro')
    ->middleware('auth')
    ->name('accion.filtro.movimientos');

Route::post('/egresos/cerrados', 'backend\EgressController@filtro')
    ->middleware('auth')
    ->name('accion.filtro.remitos');


//           *********************          //
Auth::routes();
