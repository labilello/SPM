@extends('layouts.layout')

@section('content')

    <div class="container-sm">
        @if(session('status'))
            <div class="alert alert-{{ session('type_status') }}" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="accordion mb-4" id="accordionNew">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Ingresar nuevo producto
                        </button>
                    </h5>
                </div>

                <form id="collapseOne" class="collapse show card-body" aria-labelledby="headingOne" data-parent="#accordionNew" action="{{ route('accion.reparaciones.ingresar') }}" method="POST">
                    @csrf
                    <h5 class="card-title" >Datos del producto</h5>
                    <div class="row">
                        <div class="col-sm mb-2">
                            <div class="input-group mr-lg-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Codigo EAN</div>
                                </div>
                                <input type="text" id="codigoEan" class="form-control" placeholder="1234567891011" required>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="input-group pb-1">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Nro. Serie</div>
                                </div>
                                <input type="text" name="nro_serie" id="nroSerie" class="form-control" placeholder="RF78Q5Z12G" required disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input class="btn btn-primary justify-content-center d-none" type="submit" value="Enviar">
                        </div>
                    </div>



                    <div class="justify-content-center d-none" id="spinner">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Buscando producto...</span>
                        </div>
                    </div>

                    <div id="detallesProducto" class="d-none">
                        <div class="col-xs-12 bg-light mb-2"><hr></div>

                        <h5 class="card-title">Detalles del producto</h5>
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="familia">Familia</label>
                                <input type="text" class="form-control" id="familia" placeholder="-" readonly>
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="descripcion">Descripcion</label>
                                <input type="text" class="form-control" id="descripcion" placeholder="-" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm">
                                <label for="codigoUnix">Codigo Unix</label>
                                <input type="text" class="form-control" name="id" id="id" placeholder="-" readonly>
                            </div>

                            <div class="form-group col-sm">
                                <label for="codigoUnico">Codigo Unico</label>
                                <input type="text" class="form-control" id="codigoUnico" placeholder="-" readonly >
                            </div>

                            <div class="form-group col-sm">
                                <label for="marca">Marca</label>
                                <input type="text" class="form-control" id="marca" placeholder="-" readonly >
                            </div>

                        </div>
                    </div>

                </form>
            </div>
        </div>

        <audio id="correcto" class="d-none" controls>
            <source type="audio/mp3" src="{{ asset('src/correcto.mp3') }}">
            Your browser does not support the audio element.
        </audio>
        <audio id="error" class="d-none" controls>
            <source type="audio/mp3" src="{{ asset('src/error.mp3') }}">
            Your browser does not support the audio element.
        </audio>
    </div>
@endsection
