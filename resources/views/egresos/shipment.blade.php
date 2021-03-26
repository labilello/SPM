

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

        <div class="row align-items-center">
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
                            <div class="col-3">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm mb-1 btn-block " @if( $shipment->is_closed ) disabled @endif data-toggle="modal" data-target="#staticBackdrop">
                                    Eliminar remito
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="Deleted Modal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Deshaciendo envío nro {{ $shipment->id }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Esta seguro que desea devolver todos los productos a desposito y cancelar el envio? Esta accion no podrá deshacerse. <br> Recuerde alojar los productos en la zona de pendientes de envío.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" wire:click="cancelAllShipment( {{ $shipment->repairs[ $i ]->id }} )" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <a class="btn btn-danger btn-block" target="_blank" href="{{ route('vista.egresos.remito', $shipment->id) }}" id="imprimir_remito">Imprimir remito</a>
                    @else
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Nro. Serie a despachar</span>
                        </div>
                        <input type="text" class="form-control focus" id="nro_serie" aria-label="Nro serie" aria-describedby="basic-addon1">
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="justify-content-center d-none mb-3" id="spinner">
                    <div class="spinner-border text-danger" role="status">
                        <span class="sr-only">Buscando reparación...</span>
                    </div>
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
{{--                @dd($shipment->repairs)--}}
                    @for ($i = (count($shipment->repairs) - 1); $i >= 0 ; $i--)
                        <tr>
                            <th class="py-1 align-middle" scope="row">{{ $i +  1 }}</th>
                            <td class="py-1 align-middle">{{ $shipment->repairs[$i]->product->descripcion }}</td>
                            <td class="py-1 align-middle">{{ $shipment->repairs[$i]->nro_serie }}</td>
                            <td class="text-center py-1 align-middle">
                                @if($shipment->repairs[$i]->is_repair === true)
                                    <i class="far fa-check-circle align-middle" style="color: #00cc66; font-size: 20px"></i>
                                @else
                                    <i class="far fa-times-circle align-middle" style="color: red; font-size: 20px"></i>
                                @endif
                            </td>
                            <td class="text-center py-1 align-middle">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#staticBackdrop">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="Deleted Modal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Deshaciendo envío de {{ $shipment->repairs[$i]->product->descripcion }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Esta seguro que desea devolver el producto a desposito? Esta accion no podrá deshacerse. <br> Recuerde alojar el producto en la zona de pendientes de envío.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" wire:click="cancelShipProduct( {{ $shipment->repairs[ $i ]->id }} )" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endfor
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

    </div>



