@extends('layouts.layout')

@section('content')

{{--    <audio id="audio" controls>--}}
{{--        <source type="audio/wav" src="{{ asset('src/error.wav') }}">--}}
{{--        Your browser does not support the audio element.--}}
{{--    </audio>--}}

    <div class="container-sm">
        <div class="accordion mb-4" id="accordionNew">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Ingresar nuevo producto
                        </button>
                    </h5>
                </div>

                <form id="collapseOne" class="collapse show card-body" aria-labelledby="headingOne" data-parent="#accordionNew" action="{{ route('accion.ingresar') }}" method="POST">
                    @csrf
                    @if(session('status'))
                        <div class="alert alert-{{ session('type_status') }}" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5 class="card-title" >Datos del producto</h5>
                    <div class="row">
                        <div class="col-sm mb-2">
                            <div class="input-group mr-lg-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Codigo EAN</div>
                                </div>
                                <input type="text" name="{{--codigoEan--}}codigoUnix" class="form-control" placeholder="1234567891011" required>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="input-group pb-1">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Nro. Serie</div>
                                </div>
                                <input type="text" name="nro_serie" class="form-control" placeholder="RF78Q5Z12G" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input class="btn btn-primary justify-content-center hidden" type="submit" value="Enviar">
                        </div>
                    </div>

                    <div class="col-xs-12 bg-light mb-2"><hr></div>

                    <h5 class="card-title">Detalles del producto</h5>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label for="familia">Familia</label>
                            <input type="text" class="form-control" id="familia" placeholder="TV LED" readonly tabindex="-1">
                        </div>
                        <div class="form-group col-sm-8">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" placeholder="TV LG 32' MODELO 32LG75123 - DIA DEL PADRE" readonly tabindex="-1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm">
                            <label for="codigoUnix">Codigo Unix</label>
                            <input type="text" class="form-control" name="codigoUnix" id="codigoUnix" value="2" readonly tabindex="-1">
                        </div>

                        <div class="form-group col-sm">
                            <label for="codigoUnico">Codigo Unico</label>
                            <input type="text" class="form-control" id="codigoUnico" placeholder="R-234754" readonly tabindex="-1">
                        </div>

                        <div class="form-group col-sm">
                            <label for="marca">Marca</label>
                            <input type="text" class="form-control" id="marca" placeholder="LG ELECTRONICS" readonly tabindex="-1">
                        </div>

                        <div class="form-group col-sm">
                            <label for="costo">Costo Reposicion</label>
                            <input type="text" class="form-control" id="costo" placeholder="$ 2570,74" readonly tabindex="-1">
                        </div>

                        <div class="form-group col-sm">
                            <label for="iva">IVA</label>
                            <input type="text" class="form-control" id="iva" placeholder="21 %" readonly tabindex="-1">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input class="btn btn-primary justify-content-center" type="submit" value="Enviar">
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
