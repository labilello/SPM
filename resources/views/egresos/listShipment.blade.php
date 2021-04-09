{{--@extends('layouts.layout')--}}

{{--@section('content')--}}

{{--    <div class="container-sm">--}}
{{--        @if(session('status'))--}}
{{--            <div class="alert alert-{{ session('type_status') }}" role="alert">--}}
{{--                {{ session('status') }}--}}
{{--            </div>--}}
{{--        @endif--}}

{{--        <div class="accordion" id="accordionFilter">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header" id="headingFilter">--}}
{{--                    <h5 class="card-title mb-0">--}}
{{--                        <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">--}}
{{--                            Filtros de busqueda--}}
{{--                        </button>--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--                <form method="POST" action="{{ route('accion.filtro.remitos') }}" id="collapseFilter" class="collapse card-body" aria-labelledby="headingFilter" data-parent="#accordionFilter">--}}
{{--                    @csrf--}}
{{--                    <div class="row">--}}
{{--                        <div class="form-group col">--}}
{{--                            <label for="remito_nro">Remito Nro.:</label>--}}
{{--                            <input type="text" class="form-control" id="remito_nro" name="remito_nro" value="">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col">--}}
{{--                            <label for="nro_interno">Nro. interno:</label>--}}
{{--                            <input type="text" class="form-control" id="nro_interno" name="nro_interno" value="">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col">--}}
{{--                            <label for="fecha_desde">Fecha Desde:</label>--}}
{{--                            <input type="date" class="form-control" id="fecha_desde" name="fechas[since]" value="" min="2020-08-01" max="{{ \Carbon\Carbon::now('America/Argentina/Buenos_Aires')->format('Y-m-d') }}">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col">--}}
{{--                            <label for="fecha_hasta">Fecha Hasta:</label>--}}
{{--                            <input type="date" class="form-control" id="fecha_hasta" name="fechas[to]" value="" min="2020-08-01" max="{{ \Carbon\Carbon::now('America/Argentina/Buenos_Aires')->format('Y-m-d') }}">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col form-group text-left">--}}
{{--                            <input type="submit" class="btn btn-primary mr-2" value="Buscar">--}}
{{--                            <a href="{{ route('vista.egresos.cerrados') }}" class="btn btn-secondary">Eliminar filtros</a>--}}
{{--                            <input type="hidden" value="egresos\listShipment" name="viewreturn">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div> --}}{{-- Filtro de tabla API - FETCH --}}

{{--        <div class="row justify-content-center mt-4">--}}
{{--            <h4 class="col-12">Remitos cerrados ( @isset($elements->onEachSide) {{ $elements->total() }} @else {{ count($elements )}} @endisset )</h4>--}}

{{--            <div class="col">--}}
{{--                <table class="table table-hover table-sm table-responsive-sm border-0" id="mytable">--}}
{{--                    <thead>--}}
{{--                        <tr class="border-0">--}}
{{--                            <th scope="col">#</th>--}}
{{--                            <th scope="col">Remito Nro.</th>--}}
{{--                            <th scope="col">Envio hacia</th>--}}
{{--                            <th scope="col">Nro interno</th>--}}
{{--                            <th scope="col">Despacho</th>--}}
{{--                            <th scope="col">&ensp;</th>--}}
{{--                        </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody class="table-hover">--}}
{{--                        @foreach($elements as $shipment)--}}
{{--                            <tr class="align-middle">--}}
{{--                                <td>{{ $shipment->id }}</td>--}}
{{--                                <td>{{ $shipment->name}}</td>--}}
{{--                                <td>{{ $shipment->shipto }}</td>--}}
{{--                                <td>{{ $shipment->nro_interno }}</td>--}}
{{--                                <td>{{ $shipment->updated_at->format('d/m/Y H:i:s') }}</td>--}}
{{--                                <td><a href="{{ route('vista.egresos.envio', $shipment->id) }}" target="_blank" class="btn btn-danger btn-sm btn-block">Ver remito</a></td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--                @isset($elements->onEachSide)--}}
{{--                    <div class="row">--}}
{{--                        <div class="col">{{ $elements->links('vendor.pagination.bootstrap-4') }}</div>--}}
{{--                    </div>--}}
{{--                @endisset--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@extends('layouts.layout')

@section('content')

    <div class="container-sm">
        <livewire:tables.remitos-envio-table />
    </div>

@endsection
