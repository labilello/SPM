<div x-data class="d-flex flex-column p-2">
    <input
        x-ref="input"
        type="text"
        class="form-control form-control-sm"
        wire:change="doTextFilter('{{ $index }}', $event.target.value)"
        x-on:change="$refs.input.value = ''"
    />
    <div class="d-flex flex-wrap mt-1">
        @foreach($this->activeTextFilters[$index] ?? [] as $key => $value)
        <button wire:click="removeTextFilter('{{ $index }}', '{{ $key }}')" class="text-sm btn btn-sm btn-outline-secondary ml-1 mt-1 text-uppercase">
            <span>{{ $this->getDisplayValue($index, $value) }}</span>
            <x-icons.x-circle />
        </button>
        @endforeach
    </div>
</div>
