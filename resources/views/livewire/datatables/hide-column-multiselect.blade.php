<div class="dropdown ml-lg-2 mb-lg-0 mb-1">
    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
        Mostrar / Ocultar Columnas
    </button>
    <div class="dropdown-menu dropdown-menu-right shadow-lg bg-dark rounded" aria-labelledby="dropdownMenu2" x-cloak>
        @foreach($this->columns as $index => $column)
            <!-- Columna Oculta -->
            <button class="dropdown-item @if($column['hidden']) dropdown-item-hover-dark-disable text-muted @else dropdown-item-hover-dark @endif" type="button" wire:click="toggle({{$index}})">{{ $column['label'] }}</button>
        @endforeach
    </div>
</div>
