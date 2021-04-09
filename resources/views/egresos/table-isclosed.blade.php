<span class="d-flex justify-content-around align-items-center">
    @if($value === 0)
        <span class="text-success font-weight-bold">Abierto</span>
    @elseif($value === 1)
        <span class="text-danger font-weight-bold">Cerrado</span>
    @elseif($value === null)
        <span class="text-info font-weight-bold">Desconocido</span>
    @endif
</span>
