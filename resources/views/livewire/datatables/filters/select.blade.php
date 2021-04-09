<div x-data class="d-flex flex-column p-2">
    <div class="d-flex flex-wrap">
        <select
            x-ref="select"
            name="{{ $name }}"
            class="form-control form-control-sm"
            wire:input="doSelectFilter('{{ $index }}', $event.target.value)"
            x-on:input="$refs.select.value=''"
        >
            <option value=""></option>
                @foreach($options as $value => $label)
                    @if(is_object($label))
                        <option value="{{ $label->id }}">{{ $label->name }}</option>
                    @elseif(is_array($label))
                        <option value="{{ $label['id'] }}">{{ $label['name'] }}</option>
                    @elseif(is_numeric($value))
                        <option value="{{ $label }}">{{ $label }}</option>
                    @else
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endif
                @endforeach
        </select>
    </div>

    <div class="d-flex flex-wrap mt-1">
        @foreach($this->activeSelectFilters[$index] ?? [] as $key => $value)
            <button wire:click="removeSelectFilter('{{ $index }}', '{{ $key }}')" x-on:click="$refs.select.value=''"
                class="btn btn-sm btn-outline-secondary mt-1 text-uppercase d-flex align-items-center text-sm">
                <span class="mr-2">{{ $this->getDisplayValue($index, $value) }}</span>
                <x-icons.x-circle />
            </button>
        @endforeach
    </div>
</div>
