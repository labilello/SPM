
<!-- Modal -->
<div class="modal fade" id="deleteShipment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="Deleted Modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" x-data>
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
{{--                <button type="button" class="btn btn-danger"--}}
{{--                x-on:click="--}}
{{--                    $wire.cancelAllShipment()--}}
{{--                        .then(result => { console.log( result ); })"--}}
{{--                >Eliminar</button>--}}
                <button type="button" class="btn btn-danger" x-on:click="$wire.cancelAllShipment()">Eliminar</button>
            </div>
        </div>
    </div>
</div>
