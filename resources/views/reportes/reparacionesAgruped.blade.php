@extends('layouts.layout')

@section('content')
    <div class="container">

        <div class="accordion" id="accordionFilter">
            <div class="card">
                <div class="card-header" id="headingFilter">
                    <h5 class="card-title mb-0">
                        <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
                            Filtros de busqueda
                        </button>
                    </h5>
                </div>
                <form method="GET" action="{{ route('vista.reportes.reparaciones.agrupado') }}" id="collapseFilter" class="collapse card-body" aria-labelledby="headingFilter" data-parent="#accordionFilter">
                    <div class="row">
                        <div class="form-group col">
                            <label for="type_movement">Estado actual:</label>
                            <select class="custom-select custom-select" name="type_movement" id="type_movement">
                                <option value="" selected>-- Sin filtrar --</option>
                                <option value="1" >Ingresado</option>
                                <option value="2">Reparado</option>
{{--                                <option value="3">Egresado</option>--}}
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="producto">Producto:</label>
                            <input type="text" class="form-control" id="producto" name="producto">
                        </div>
                        <div class="form-group col">
                            <label for="familia">Familia:</label>
                            <input type="text" class="form-control" id="familia" name="familia">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col form-group text-left">
                            <input type="submit" class="btn btn-primary mr-2" value="Buscar">
                            <a href="{{ route('vista.reportes.reparaciones.agrupado') }}" class="btn btn-secondary">Eliminar filtros</a>
                        </div>
                    </div>
                </form>
            </div>
        </div> {{-- Filtro de tabla --}}

        <div class="row justify-content-center mt-4">
            <h4 class="col-12">Reparaciones ( @isset($elements->onEachSide) {{ $elements->total() }} @else {{ count($elements) }} @endisset )</h4>
            <div class="col">
                <table class="table table-hover table-sm table-responsive-sm border-0">
                    <thead>
                        <tr class="border-0">
                            <th scope="col">Estado actual</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Familia</th>
                            <th scope="col">Estado Producto</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                        @foreach($elements as $repair)
                            <tr>
                                <td>{{ $repair->status->descripcion }}</td>
                                <td>{{ $repair->product_id }}</td>
                                <td>{{ $repair->descripcion }}</td>
                                <td>{{ $repair->familia }}</td>
                                @if($repair->is_repair === null)
                                    <td class="text-info font-weight-bold">Desconocido</td>
                                @elseif($repair->is_repair === true)
                                    <td class="text-success font-weight-bold">Reparado</td>
                                @else
                                    <td class="text-danger font-weight-bold">Irreparable</td>
                                @endif
                                <td>{{ $repair->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @isset($elements->onEachSide)
                    <div class="row">
                        <div class="col">{{ $elements->appends(request()->input())->links() }}</div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
