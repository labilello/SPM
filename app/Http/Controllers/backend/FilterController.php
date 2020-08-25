<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filtroTabla(Request $request) {
        $key = $request->get('clave');
        $filter = $request->get('buscarPor');
        $view = $request->get('vista');
        $entity = '\\App\\' . $request->get('entidad');

        if($filter == "")
            $elements = $entity::paginate();
        else {
            $explode = explode(".", $filter);

            if(count($explode) > 1){
                $elements = $entity::whereHas($explode[0], function (Builder $query) use ($explode, $key) {
                    $query->where($explode[1], 'like', "%$key%");
                })->paginate();

            } else
                $elements = $entity::where($filter, 'LIKE', "%$key%")->paginate();
        }

        return view($view, [
            'elements' => $elements
        ]);
    }
}
