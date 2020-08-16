@extends('layouts.layout')

@section('content')

    <div class="container-sm">

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
            <h4 class="col-12">Historial de reparaciones</h4>
            <div class="col">
                <table class="table table-hover table-sm table-responsive-sm border-0">
                    <thead>
                        <tr class="border-0">
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Fecha Ingreso</th>
                            <th scope="col">Fecha Egreso</th>
                            <th scope="col">Familia</th>
                            <th scope="col">Nro. Serie</th>
                            <th scope="col">¿Reparado?</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Nota</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                        @foreach($repairs as $repair)
                            <tr>
                                <td>{{ $repair->id }}</td>
                                <td>{{ $repair->product->descripcion }}</td>
                                <td>{{ $repair->date_in }}</td>
                                <td class="text-center">@if($repair->date_out == null) - @else {{ $repair->date_out }} @endif</td>
                                <td>{{ $repair->product->familia }}</td>
                                <td>{{ $repair->nro_serie }}</td>
                                <td class="text-center">
                                    @if($repair->is_repair == null)
                                        -
                                    @elseif($repair->is_repair == true)
                                        Si
                                    @else
                                        No
                                    @endif
                                </td>
                                <td>{{ $repair->status->descripcion }}</td>
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
