

{{--    <audio id="audio" controls>--}}
{{--        <source type="audio/wav" src="{{ asset('src/error.wav') }}">--}}
{{--        Your browser does not support the audio element.--}}
{{--    </audio>--}}

<div class="container-sm">
    @if(session('status'))
        <div class="alert alert-{{ session('type_status') }}" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row align-items-center" x-data="{ open: false }">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    Configuración de envío
                </div>
                <div class="card-body">
                    <form class="row align-items-center" action="{{ route('accion.egresos.cerrar', $shipment->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="col-9">
                            <div class="row">
                                <div class="form-group col-8">
                                    <label for="shipto">Envío hacia:</label>
                                    <input type="text" class="form-control" value="{{ $shipment->shipto }}" readonly>
                                </div>
                                <div class="form-group col-4">
                                    <label for="nro_interno">Nro. remito interno:</label>
                                    <input type="text" class="form-control" id="nro_interno" name="nro_interno" value="{{ $shipment->nro_interno }}" @if( $shipment->is_closed ) disabled @else required @endif>
                                </div>
                            </div>
                        </div>
                        <div class="col-3" x-data>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-sm mb-1 btn-block " @if( $shipment->is_closed ) disabled @endif data-toggle="modal" data-target="#deleteShipment">
                                Eliminar remito
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm btn-block" @if( $shipment->is_closed ) disabled @endif onsubmit="cerrarRemito(event)">Cerrar remito</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    Detalle de envío
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="text-uppercase d-block m-1">Envío: <span class="font-weight-bold">{{ $shipment->name }}</span></p>
                            <p class="text-uppercase d-block m-1">Productos: <span class="font-weight-bold" id="cant_products">{{ count($shipment->repairs) }}</span></p>
                            <p class="text-uppercase d-block m-1">Estado: <span class="font-weight-bold @if( $shipment->is_closed ) text-danger ">Cerrado</span></p> @else text-success ">Abierto</span></p> @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="col">
            <div class="input-group">
                @if( $shipment->is_closed )
{{--                    <button class="col btn btn-danger mr-2" wire:click="downloadPDF" >Imprimir remito</button>--}}
                    <a class="col btn btn-danger mr-2" target="_blank" href="{{ route('vista.egresos.remito', $shipment->id) }}" >Descargar remito</a>
                    <button class="col btn btn-success ml-2" wire:click="downloadExcel">Exportar a Excel</button>
                @else
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Nro. Serie a despachar</span>
                    </div>
                    <input x-data x-ref="input" x-on:keydown.enter="$refs.input.value=''" wire:keydown.enter="addProduct($event.target.value)"
                           type="text" class="form-control focus" id="nro_serie" aria-label="Nro serie" aria-describedby="basic-addon1">
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div wire:loading.flex class="justify-content-center align-items-center mb-3" id="spinner">
                <div class="spinner-border text-danger" role="status">
                </div>
                <span class="text-muted ml-2">Procesando información...</span>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover" id="mytable">
            <thead class="thead-dark">
            <tr>
                <th scope="col" style="width: 5%">#</th>
                <th scope="col" style="width: 60%">Producto</th>
                <th scope="col" style="width: 30%">Nro. Serie</th>
                <th scope="col" style="width: 5%">¿Reparado?</th>
                <th scope="col" style="width: 5%">Acciones</th>
            </tr>
            </thead>
            <tbody>
{{--            @for($n = count($repairs) - 1; $n >= 0; $n--)--}}
            @foreach($repairs as $repair)
                <tr>
                    <th class="py-1 align-middle" scope="row">{{ $repair->id }}</th>
                    <td class="py-1 align-middle">{{ $repair->product->descripcion }}</td>
                    <td class="py-1 align-middle">{{ $repair->nro_serie }}</td>
                    <td class="text-center py-1 align-middle">
                        @if($repairs[ $n ]->is_repair === true)
                            <i class="far fa-check-circle align-middle" style="color: #00cc66; font-size: 20px"></i>
                        @else
                            <i class="far fa-times-circle align-middle" style="color: red; font-size: 20px"></i>
                        @endif
                    </td>
                    <td class="text-center py-1 align-middle">
                        @if($shipment->is_closed)
                            <button type="button" class="btn btn-sm btn-danger disabled">
                                <i class="fas fa-trash"></i>
                            </button>
                        @else
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-danger" wire:click="cancelShipProduct({{$repairs[ $n ]->id}})">
                                <i class="fas fa-trash"></i>
                            </button>
                        @endif

{{--                        <!-- Modal -->--}}
{{--                        <div class="modal fade" id="deleteProduct{{$n}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="Deleted Modal" aria-hidden="true">--}}
{{--                            <div class="modal-dialog">--}}
{{--                                <div class="modal-content">--}}
{{--                                    <div class="modal-header">--}}
{{--                                        <h5 class="modal-title" id="staticBackdropLabel">Deshaciendo envío de {{ $repairs[ $n ]->product->descripcion }}</h5>--}}
{{--                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                                            <span aria-hidden="true">&times;</span>--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-body text-left">--}}
{{--                                        ¿Esta seguro que desea devolver el producto a desposito? Esta accion no podrá deshacerse. <span class="d-block text-muted mt-2">Recuerde alojar el producto en la zona de pendientes de envío.</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="modal-footer">--}}
{{--                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>--}}
{{--                                        <button type="button" wire:click="cancelShipProduct({{$repairs[ $n ]->id}})" class="btn btn-danger">Eliminar</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </td>
                </tr>
{{--            @endfor--}}
            @endforeach
            </tbody>

        </table>
    </div>

    <audio id="correcto" class="d-none" controls>
        <source type="audio/mp3" src="{{ asset('src/correcto.mp3') }}">
        Your browser does not support the audio element.
    </audio>
    <audio id="error" class="d-none" controls>
        <source type="audio/mp3" src="{{ asset('src/error.mp3') }}">
        Your browser does not support the audio element.
    </audio>
    @include('egresos.modals')
</div>
