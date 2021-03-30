<?php

namespace App\Http\Livewire\Ingresos;

use App\Http\Traits\SweetAlertLive;
use App\Movement;
use App\Product;
use App\Repair;
use App\Status;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Nuevo extends Component
{
    use SweetAlertLive;
    private $producto;

    public function buscarProducto( $ean ) {
        $coinidencias = Product::where('codigo_barras', 'LIKE', "%{$ean}%")->get()->toArray();
        if(count($coinidencias) > 50)
            return [];
        return $coinidencias;
    }

    public function agregarProducto( $prodid, $nroserie) {

        $data = Validator::make(
            ['nroserie' => $nroserie, 'prodid' => $prodid],
            ['nroserie' => 'required', 'prodid' => 'min:3'],
            ['required' => 'Este elemento es obligatorio', 'min' => 'Este elemento debe tener al menos :min caracteres'],
        )->validate();

        // Cantidad de reparaciones sin egresar para el nro de serie ingresado
        $cantRepairs = Repair::where('nro_serie', $data['nroserie'])
            ->where('status_id', '<>', Status::where('descripcion', 'Egresado')->get()->first()->id)
            ->get()
            ->count();

        if($cantRepairs > 0) {
            $this->crearAlerta('Ya existe una reparacion en curso para este numero de serie. Producto no ingresado',
                'Error al ingresar',
                'error')
                ->toast()
                ->getDataToDispatch();
            return 0;
        }


        /* TABLA INGRESOS */
        $ingreso = new Repair();
        $ingreso->date_in = now();
        $ingreso->date_out = null;
        $ingreso->status_id = Status::where('descripcion', 'Ingresado')->get()->first()->id;
        $ingreso->nro_serie =$data['nroserie'];
        $ingreso->product_id = $data['prodid'];

        $ingreso->save();

        /* TABLA MOVIMIENTOS */
        $movimiento = new Movement();
        $movimiento->user_id = Auth::user()->id;
        $movimiento->repair_id = $ingreso->id;
        $movimiento->status_id = $ingreso->status_id;

        $movimiento->save();

        return 1;
    }

    public function render()
    {

        return view('livewire.ingresos.nuevo', [
            'producto' => $this->producto
        ]);
    }
}
