@extends('layouts.layout')

@section('content')
    <div class="container">
{{--        <div class="row justify-content-end">--}}
{{--            <a role="button" class="btn btn-outline-secondary mb-3" href="{{ route('vista.reparaciones.pendientes') }}">Nuevo ingreso</a>--}}
{{--        </div>--}}

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Filtros de busqueda</h5>{{-- FILTROS --}}
                <input type="text" class="col-12 form-control">
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

{{--                        {{ $movements->links() }}--}}

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
