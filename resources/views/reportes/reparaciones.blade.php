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
                <form method="GET" action="{{ route('vista.filtro') }}" id="collapseFilter" class="collapse card-body" aria-labelledby="headingFilter" data-parent="#accordionFilter">
                    @csrf
                    <div class="row align-items-end">
                        <div class="form-group col-sm-7">
                            <label for="clave">Clave de busqueda:</label>
                            <input type="text" class="form-control" id="clave" name="clave">
                        </div>
                        <div class="form-group col-sm-3 pl-1">
                            <label for="buscarPor">Buscar por:</label>
                            <select class="custom-select custom-select" name="buscarPor">
                                <option value="product.descripcion" selected>Descripcion producto</option>
                                <option value="product.familia">Familia producto</option>
                                <option value="nro_serie">Nro. Serie</option>
                                <option value="status.descripcion">Estado</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-2 pl-1">
                            <input type="submit" class="btn btn-primary btn-sm w-100 mb-sm-1" value="Buscar">
                            <a href="{{ route('vista.reportes.reparaciones') }}" class="btn btn-secondary btn-sm w-100">Eliminar filtros</a>
                        </div>
                    </div>
                    <input type="hidden" value="reportes.reparaciones" name="vista">
                    <input type="hidden" value="Repair" name="entidad">
                </form>
            </div>
        </div> {{-- Filtro de tabla --}}

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
                        @foreach($elements as $repair)
                            <tr>
                                <td>{{ $repair->id }}</td>
                                <td>{{ $repair->product->descripcion }}</td>
                                <td>{{ $repair->date_in->format('d/m/Y H:i:s') }}</td>
                                <td class="text-center">@if($repair->date_out == null) - @else {{ $repair->date_out->format('d/m/Y H:i:s') }} @endif</td>
                                <td>{{ $repair->product->familia }}</td>
                                <td>{{ $repair->nro_serie }}</td>
                                @if($repair->is_repair === null)
                                    <td class="text-info font-weight-bold">Desconocido</td>
                                @elseif($repair->is_repair === true)
                                    <td class="text-success font-weight-bold">Reparado</td>
                                @else
                                    <td class="text-danger font-weight-bold">Irreparable</td>
                                @endif
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
                    <div class="col">{{ $elements->appends(request()->input())->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
