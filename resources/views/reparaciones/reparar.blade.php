@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card">
            <h4 class="card-header">Finalizacion de reparacion</h4>
            <form class="show card-body" action="{{ route('accion.reparaciones.reparar', ['repair' => $element->id]) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row">
                    <div class="col-sm">
                        <div class="input-group pb-1">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Detalle</div>
                            </div>
                            <textarea rows="3" name="note" class="form-control custom-select" ></textarea>
                        </div>

                        <div class="input-group pb-1">
                            <div class="input-group-prepend">
                                <div class="input-group-text">¿Reparado?</div>
                            </div>
                            <select name="is_repair" class="form-control">
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 ">
                    <div class="col-sm">
                        <input type="submit" value="Finalizar reparacion" class="btn btn-primary" >
                    </div>
                </div>

            </form>
        </div>

    </div>


    </div>
@endsection
