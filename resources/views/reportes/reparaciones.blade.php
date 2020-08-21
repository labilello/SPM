@extends('layouts.layout')

@section('content')

    <div class="container-sm">

        @include('layouts.filtrotabla')

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
                                        <i class="far fa-check-circle" style="color: #00cc66; font-size: 20px"></i>
                                    @else
                                        <i class="far fa-times-circle" style="color: red; font-size: 20px"></i>
                                    @endif
                                </td>
                                <td>{{ $repair->status->descripcion }}</td>
                                <td class="text-center">
                                    @if($repair->note != '')
                                        <i class="fas fa-sticky-note" data-toggle="tooltip" data-placement="right" title="{{ $repair->note }}" style="color: #1f6fb2; font-size: 20px"></i>
                                    @else
                                        -
                                    @endif
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
