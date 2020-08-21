@extends('layouts.layout')

@section('content')

    <div class="container-sm">
        @if(session('status'))
            <div class="alert alert-{{ session('type_status') }}" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @include('layouts.filtrotabla')

        <div class="row justify-content-center mt-4">
            <h4 class="col-12">Pendientes de reparacion ({{ $repairs->count() }})</h4>
            <div class="col">
                <table class="table table-hover table-sm table-responsive-sm border-0" id="mytable">
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
                                <td>{{ $repair->date_in->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $repair->product->familia }}</td>
                                <td>{{ $repair->nro_serie }}</td>
                                <td><a href="{{ route('vista.reparaciones.reparar', ['repair' => $repair->id ]) }}">Reparar</a></td>

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
