<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Movement;
use App\Product;
use App\Repair;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Boolean;

class RepairController extends Controller
{


    public function ingresar(Request $request)
    {
        $datosRequest = $request->all();

        // Cantidad de reparaciones sin egresar para el nro de serie ingresado
        $cantRepairs = Repair::where('nro_serie', $datosRequest['nro_serie'])
            ->where('status_id', '<>', Status::where('descripcion', 'Egresado')->get()->first()->id)
            ->get()
            ->count();

        if($cantRepairs > 0)
            return redirect(route('vista.reparaciones.nuevo'))->with([
                'type_status' => 'danger',
                'status' => "Ya existe una reparacion en curso para este numero de serie. Producto no ingresado"
            ]);


        /* TABLA INGRESOS */
        $ingreso = new Repair();
        $ingreso->date_in = now();
        $ingreso->date_out = null;
        $ingreso->status_id = Status::where('descripcion', 'Ingresado')->get()->first()->id;
        $ingreso->nro_serie = $datosRequest['nro_serie'];
//        $ingreso->product_id = Product::find($datosRequest['codigo_unix'])->codigo_unix;
        $ingreso->product_id = $datosRequest['codigo_unix'];

        $ingreso->save();

        /* TABLA MOVIMIENTOS */
        $movimiento = new Movement();
        $movimiento->user_id = Auth::user()->getAuthIdentifier();
        $movimiento->repair_id = $ingreso->id;
        $movimiento->status_id = $ingreso->status_id;

        $movimiento->save();

        return back()->with([
                'type_status' => 'success',
                'status' => "El producto {$ingreso->product_id->descripcion} fue ingresado correctamente"
            ]);

    }




    public function reparar(Request $request, Repair $repair)
    {
        if($repair->status->id > 1)
            return redirect(route('vista.reparaciones.pendientes'))->with([
                'type_status' => 'danger',
                'status' => "La reparacion que intenta reparar se encuentra en estado \"{$repair->status->descripcion}\""
            ]);

        $repair->note = $request->input('note');
        $repair->is_repair = (bool) $request->input('is_repair');
        $repair->status_id = Status::where('descripcion', 'Reparado')->get()->first()->id;
        $repair->save();

        /* TABLA MOVIMIENTOS */
        $movimiento = new Movement();
        $movimiento->user_id = Auth::user()->getAuthIdentifier();
        $movimiento->repair_id = $repair->id;
        $movimiento->status_id = $repair->status_id;

        $movimiento->save();

        return redirect(route('vista.reparaciones.pendientes'))->with([
            'type_status' => 'success',
            'status' => "Producto con numero de serie $repair->nro_serie reparado. Enviar a deposito para su egreso"
        ]);

    }

    public function egresar(Repair $repair = null, Request $request)
    {
        if(!$repair) {
            $repair = Repair::where('nro_serie', '=', $request->get('nro_serie'))
                ->where('status_id', '=', '2')
                ->first();


            if(!$repair)
                return redirect(route('vista.egresos.nuevo'))->with([
                    'type_status' => 'danger',
                    'status' => "No se encontro reparacion pendiende de ingreso con el nro de serie: {$request->get('nro_serie')}."
                ]);

        }

        if($repair->status->id > 1)
            return redirect(route('vista.egresos.pendientes'))->with([
                'type_status' => 'danger',
                'status' => "La reparacion que intenta reparar se encuentra en estado \"{$repair->status->descripcion}\""
            ]);

        $repair->date_out = now();
        $repair->status_id = Status::where('descripcion', 'Egresado')->get()->first()->id;
        $repair->save();

        /* TABLA MOVIMIENTOS */
        $movimiento = new Movement();
        $movimiento->user_id = Auth::user()->getAuthIdentifier();
        $movimiento->repair_id = $repair->id;
        $movimiento->status_id = $repair->status_id;

        $movimiento->save();

        return back()->with([
            'type_status' => 'success',
            'status' => "Producto con numero de serie {$repair->nro_serie} egresado."
        ]);
    }
}
