<span class="d-flex justify-content-around align-items-center">
    @if($value === 0)
        <span class="text-danger font-weight-bold">Irreparable</span>
    @elseif($value === 1)
        <span class="text-success font-weight-bold">Reparado</span>
    @elseif($value === null)
        <span class="text-info font-weight-bold">Desconocido</span>
    @endif
</span>
