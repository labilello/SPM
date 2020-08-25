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
                <form method="GET" action="{{ route('vista.filtro') }}" id="collapseFilter" class="collapse card-body" aria-labelledby="headingFilter" data-parent="#accordionFilter">
                    @csrf
                    <div class="row align-items-end">
                        <div class="form-group col-sm-7">
                            <label for="clave">Clave de busqueda:</label>
                            <input type="text" class="form-control" id="clave" name="clave" required>
                        </div>
                        <div class="form-group col-sm-3 pl-1">
                            <label for="buscarPor">Buscar por:</label>
                            <select class="custom-select custom-select" name="buscarPor">
                                <option value="status.descripcion" selected>Tipo movimiento</option>
                                <option value="repair.nro_serie">Nro. Serie</option>
                                <option value="user.name">Usuario</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-2 pl-1">
                            <input type="submit" class="btn btn-primary btn-sm w-100 mb-sm-1" value="Buscar">
                            <a href="{{ route('vista.reportes.productos') }}" class="btn btn-secondary btn-sm w-100">Eliminar filtros</a>
                        </div>
                        <input type="hidden" value="reportes.movements" name="vista">
                        <input type="hidden" value="Movement" name="entidad">
                    </div>
                </form>
            </div>
        </div> {{-- Filtro de tabla --}}

        <div class="row justify-content-center mt-4">
            <h4 class="col-12">Historial de movimientos</h4>
            <div class="col">
                <table class="table table-hover table-sm table-responsive-sm border-0">
                    <thead>
                        <tr class="border-0">
                            <th scope="col">#</th>
                            <th scope="col">Tipo Movimiento</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Nro. Serie</th>
                            <th scope="col">Usuario</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                        @foreach($elements as $movement)
                            <tr>
                                <td>{{ $movement->id }}</td>
                                <td>{{ $movement->status->descripcion }}</td>
                                <td>{{ $movement->created_at }}</td>
                                <td>{{ $movement->repair->product->descripcion }}</td>
                                <td>{{ $movement->repair->nro_serie }}</td>
                                <td>{{ $movement->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">{{ $elements->appends(request()->input())->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
