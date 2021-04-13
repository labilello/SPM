<span class="d-flex justify-content-around align-items-center" x-data>
    @if($note != '')
        <button x-on:click="mostrarNotaReparacion($refs.divNote)" type="button" class="p-0 btn btn-sm text-base fas fa-sticky-note" style="color: #1f6fb2;"></button>
        <div x-ref="divNote" class="d-none">{{ str_replace(PHP_EOL, '<br>', $note) }}</div>
    @else
        -
    @endif
</span>
