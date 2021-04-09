<div class="d-flex justify-content-around align-items-center">
    <a href="{{ route('vista.reparaciones.reparar', ['repair' => $id ]) }}" target="_self" class="border-0 btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Reparar equipo">
        <i class="fas fa-tools"></i>
    </a>

    @if( \Illuminate\Support\Facades\Auth::user()->email == 'labilello' || \Illuminate\Support\Facades\Auth::user()->email == 'mponce')
        <button wire:click="delete({{ $id }})" class="btn btn-outline-danger border-0 btn-sm">
            <i class="fas fa-trash"></i>
        </button>
    @endif
</div>
