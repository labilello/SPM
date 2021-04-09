<span class="d-flex justify-content-around align-items-center">
    @if($note != '')
        <button x-data x-on:click="mostrarNotaReparacion('{{$note}}')" type="button" class="p-0 btn btn-sm text-base fas fa-sticky-note" style="color: #1f6fb2;"></button>
    @else
        -
    @endif
</span>
