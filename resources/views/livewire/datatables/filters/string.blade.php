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
            <button wire:click="removeTextFilter('{{ $index }}', '{{ $key }}')" type="button" class="text-sm btn btn-sm btn-outline-secondary ml-1 mt-1 text-uppercase">
                {{ $this->getDisplayValue($index, $value) }} <span style=""><x-icons.x-circle /></span>
            </button>
        @endforeach
    </div>
{{--    <div class="flex flex-wrap max-w-48 space-x-1">--}}
{{--        @foreach($this->activeTextFilters[$index] ?? [] as $key => $value)--}}
{{--        <button wire:click="removeTextFilter('{{ $index }}', '{{ $key }}')" class="m-1 pl-1 flex items-center uppercase tracking-wide bg-gray-300 text-white hover:bg-red-600 rounded-full focus:outline-none text-xs space-x-1">--}}
{{--            <span>{{ $this->getDisplayValue($index, $value) }}</span>--}}
{{--            <x-icons.x-circle />--}}
{{--        </button>--}}
{{--        @endforeach--}}
{{--    </div>--}}
</div>
