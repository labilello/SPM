@extends('layouts.layout')

@section('content')

    <div class="container-sm">
        @if(session('status'))
            <div class="alert alert-{{ session('type_status') }}" role="alert">
                {{ session('status') }}
            </div>
        @endif
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
            <h4 class="col-12">Pendientes de egreso ({{ $repairs->count() }})</h4>
            <div class="col">
                <table class="table table-hover table-sm table-responsive-sm border-0">
                    <thead>
                        <tr class="border-0">
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Fecha Ingreso</th>
                            <th scope="col">Familia</th>
                            <th scope="col">Nro. Serie</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                        @foreach($repairs as $repair)
                            <tr>
                                <td>{{ $repair->id }}</td>
                                <td>{{ $repair->product->descripcion }}</td>
                                <td>{{ $repair->date_in }}</td>
                                <td>{{ $repair->product->familia }}</td>
                                <td>{{ $repair->nro_serie }}</td>
                                <td>
                                    <form method="POST" action="{{ route('accion.reparaciones.egresar', ['repair' => $repair->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Egresar" class="btn-link btn p-0">
{{--                                        <a href="{{ route('vista.reparaciones.reparar', ['repair' => $repair->id ]) }}">Egresar</a>--}}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">{{ $repairs->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
