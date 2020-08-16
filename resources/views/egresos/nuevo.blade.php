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
                            Egresar nuevo producto
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
