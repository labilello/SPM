@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Modo de Desarrollo activado!</strong> No olvidar desactivar el modo de desarrollo antes de pasar a produccion.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header bg-success text-white">{{ __('Linea de reparacion') }}</div>

                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('vista.reparaciones.nuevo') }}" class="btn btn-toolbar text-left mb-1" role="button">Ingresar productos</a>
                        <a href="{{ route('vista.reparaciones.pendientes') }}" class="btn btn-toolbar text-left mb-1" role="button">Reparaciones pendientes</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">{{ __('Desposito') }}</div>

                <div class="card-body">
                    <div class="list-group">
                        <a href="{{ route('vista.egresos.nuevo') }}" class="btn btn-toolbar text-left mb-1" role="button">Egresar producto</a>
                        <a href="{{ route('vista.egresos.pendientes') }}" class="btn btn-toolbar text-left mb-1" role="button">Egresos pendientes</a>
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
                        <a href="{{ route('vista.reportes.reparaciones') }}" class="btn btn-toolbar text-left mb-1" role="button">Listado de reparaciones</a>
                        <a href="{{ route('vista.movimientos') }}" class="btn btn-toolbar text-left mb-1" role="button">Historial de movimientos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
