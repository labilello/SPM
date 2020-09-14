@extends('layouts.layout')

@section('content')
<div class="container">
{{--    <div class="alert alert-warning alert-dismissible fade show" role="alert">--}}
{{--        <strong>Modo de Desarrollo activado!</strong> No olvidar desactivar el modo de desarrollo antes de pasar a produccion.--}}
{{--        <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--            <span aria-hidden="true">&times;</span>--}}
{{--        </button>--}}
{{--    </div>--}}

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">{{ __('Linea de reparacion') }}</div>

                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('vista.reparaciones.nuevo') }}" class="btn btn-toolbar text-left mb-1" role="button">Ingresar productos</a>
                        <a href="{{ route('vista.reparaciones.pendientes') }}" class="btn btn-toolbar text-left mb-1" role="button">Lista de reparaciones pendientes</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">{{ __('Desposito') }}</div>

                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('vista.egresos.index') }}" class="btn btn-toolbar text-left mb-1" role="button">Remitos de envío</a>
                        <a href="{{ route('vista.egresos.pendientes') }}" class="btn btn-toolbar text-left mb-1" role="button">Lista de reparaciones pendientes de egreso</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-danger text-white">{{ __('Reportes') }}</div>

                <div class="card-body">
                    <div class="list-group">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vista.reportes.reparaciones') }}" class="btn btn-toolbar text-left mb-1" role="button">Reparaciones detalladas</a>
                            <i class="far fa-question-circle" data-toggle="tooltip" data-placement="left" title="Listado de reparaciones con su estado actual" style="color: #1f6fb2; font-size: 20px"></i>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vista.reportes.reparaciones.agrupado') }}" class="btn btn-toolbar text-left mb-1" role="button">Reparaciones agrupadas</a>
                            <i class="far fa-question-circle" data-toggle="tooltip" data-placement="left" title="Conteo de reparaciones agrupadas por producto" style="color: #1f6fb2; font-size: 20px"></i>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vista.reportes.movimientos') }}" class="btn btn-toolbar text-left mb-1" role="button">Movimientos detallados</a>
                            <i class="far fa-question-circle" data-toggle="tooltip" data-placement="left" title="Listado de movimientos de reparaciones" style="color: #1f6fb2; font-size: 20px"></i>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vista.reportes.movimientos.agrupado') }}" class="btn btn-toolbar text-left mb-1" role="button">Movimientos agrupados</a>
                            <i class="far fa-question-circle" data-toggle="tooltip" data-placement="left" title="Conteo de movimientos agrupadas por producto" style="color: #1f6fb2; font-size: 20px"></i>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('vista.reportes.productos') }}" class="btn btn-toolbar text-left mb-1" role="button">Productos</a>
                            <i class="far fa-question-circle" data-toggle="tooltip" data-placement="left" title="Listado de productos registrados" style="color: #1f6fb2; font-size: 20px"></i>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
