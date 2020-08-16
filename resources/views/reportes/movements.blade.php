@extends('layouts.layout')

@section('content')
    <div class="container">
{{--        <div class="row justify-content-end">--}}
{{--            <a role="button" class="btn btn-outline-secondary mb-3" href="{{ route('vista.reparaciones.pendientes') }}">Nuevo ingreso</a>--}}
{{--        </div>--}}

        <div class="accordion" id="accordionFilter">
            <div class="card">
                <div class="card-header" id="headingFilter">
                    <h5 class="card-title mb-0">
                        <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
                            Filtros de busqueda
                        </button>
                    </h5>
                </div>
                <div id="collapseFilter" class="was-validated collapse card-body" aria-labelledby="headingFilter" data-parent="#accordionFilter">
                    <input type="text" class="col-12 form-control">
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <h4 class="col-12">Historial de movimientos</h4>
            <div class="col">
                <table class="table table-hover table-responsive-sm">
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
                        @foreach($movements as $movement)
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
                    <div class="col">{{ $movements->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
