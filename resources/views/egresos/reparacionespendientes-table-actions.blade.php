<div class="d-flex justify-content-around align-items-center">
    @if( \Illuminate\Support\Facades\Auth::user()->email == 'labilello' || \Illuminate\Support\Facades\Auth::user()->email == 'mponce')
        <button wire:click="delete({{ $id }})" class="btn btn-outline-danger border-0 btn-sm">
            <i class="fas fa-trash"></i>
        </button>
    @else
        <button class="btn btn-outline-danger border-0 btn-sm disabled">
            <i class="fas fa-trash"></i>
        </button>
    @endif
</div>
