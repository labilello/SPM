@extends('layouts.layout')

@section('content')

{{--    <audio id="audio" controls>--}}
{{--        <source type="audio/wav" src="{{ asset('src/error.wav') }}">--}}
{{--        Your browser does not support the audio element.--}}
{{--    </audio>--}}

    <div class="container-sm">
        <h2 class="text-center text-uppercase text-primary font-weight-bold">Envío de productos ya inspeccionados</h2>
        <hr>
        @if(session('status'))
            <div class="alert alert-{{ session('type_status') }} my-2" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row mt-4">
            <div class="col-md-4 order-md-2">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Envíos sin cerrar</span>
                    <span class="badge badge-secondary badge-pill">{{ $shipments->count() }}</span>
                </h4>
                <div class="list-group overflow-scroll">
                    @if( $shipments->count() > 0)
                        @foreach($shipments as $shipment)
                            <a href="{{ route('vista.egresos.envio', [$shipment]) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $shipment->name }}</h5>
                                    <small>Hace {{ $shipment->created_at->diffInDays(now()) }} días</small>
                                </div>
                                <small class="d-block">Última modificación: <span class="font-weight-bold">{{ $shipment->created_at->format('d/m/Y \- H:m') }}</span></small>
                                <small>Cantidad de productos: <span class="font-weight-bold">{{ $shipment->repairs->count() }}</span></small>
                            </a>
                        @endforeach
                    @else
                        <small class="list-group-item">No hay envíos sin cerrar</small>
                    @endif
                </div>
            </div>

            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Nuevo envío</h4>
                <form action="{{ route('accion.egresos.nuevo') }}" method="POST">
                    @csrf
                    <div class="row mb-2">
                        <div class="col">
                            <label for="name">Remito Nro.:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ \Carbon\Carbon::now('America/Argentina/Buenos_Aires')->format('Ymd-His') }}" readonly>
                        </div>
                        <div class="col">
                            <label for="shipto">Envío hacia:</label>
                            <select name="shipto" id="shipto" class="form-control">
                                <option value="Desposito Tablada - Garbarino" selected>Depósito Tablada - Garbarino</option>
                            </select>
                        </div>
                    </div>
                    <hr class="mb-4">

                    <button class="btn btn-primary btn-lg btn-block" type="submit">Crear nuevo envío</button>

                </form>
            </div>

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
@endsection
