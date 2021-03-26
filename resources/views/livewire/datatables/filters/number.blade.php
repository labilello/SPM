<div class="d-flex flex-column p-2">
{{--    <div x-data class="relative flex">--}}
{{--        <input--}}
{{--            x-ref="input"--}}
{{--            type="number"--}}
{{--            wire:input.debounce.500ms="doNumberFilterStart('{{ $index }}', $event.target.value)"--}}
{{--            class="m-1 pr-6 text-sm leading-4 flex-grow form-input"--}}
{{--            placeholder="MIN"--}}
{{--        />--}}
{{--        <div class="absolute inset-y-0 right-0 pr-2 flex items-center">--}}
{{--            <button x-on:click="$refs.input.value=''" wire:click="doNumberFilterStart('{{ $index }}', '')" class="inline-flex text-gray-400 hover:text-red-600 focus:outline-none" tabindex="-1">--}}
{{--                <x-icons.x-circle class="h-3 w-3 stroke-current" />--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div x-data class="relative flex">--}}
{{--        <input--}}
{{--            x-ref="input"--}}
{{--            type="number"--}}
{{--            wire:input.debounce.500ms="doNumberFilterEnd('{{ $index }}', $event.target.value)"--}}
{{--            class="m-1 pr-6 text-sm leading-4 flex-grow form-input"--}}
{{--            placeholder="MAX"--}}
{{--        />--}}
{{--        <div class="absolute inset-y-0 right-0 pr-2 flex items-center">--}}
{{--            <button x-on:click="$refs.input.value=''" wire:click="doNumberFilterEnd('{{ $index }}', '')" class="inline-flex text-gray-400 hover:text-red-600 focus:outline-none" tabindex="-1">--}}
{{--                <x-icons.x-circle class="h-3 w-3 stroke-current" />--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div x-data class="w-full form-control form-control-sm d-flex align-items-center mb-1 p-0">
        <input
            x-ref="input"
            type="number"
            wire:input.debounce.500ms="doNumberFilterStart('{{ $index }}', $event.target.value)"
            placeholder="MIN"
            class="h-full pl-2 bg-transparent border-0 text-muted flex-grow-1">
        <button x-on:click="$refs.input.value=''" wire:click="doNumberFilterStart('{{ $index }}', '')"
                class="btn btn-sm p-0 pr-2 focus:outline-none ml-1" type="button" tabindex="-1">
            <x-icons.x-circle class="h-3 w-3 stroke-current text-secondary" />
        </button>
    </div>
    <div x-data class="w-full form-control form-control-sm d-flex align-items-center p-0">
        <input
            x-ref="input"
            type="number"
            wire:input.debounce.500ms="doNumberFilterEnd('{{ $index }}', $event.target.value)"
            placeholder="MAX"
            class="h-full pl-2 bg-transparent border-0 text-muted flex-grow-1">
        <button x-on:click="$refs.input.value=''" wire:click="doNumberFilterEnd('{{ $index }}', '')"
                class="btn btn-sm p-0 pr-2 focus:outline-none ml-1" type="button" tabindex="-1">
            <x-icons.x-circle class="h-3 w-3 stroke-current text-secondary" />
        </button>
    </div>

</div>
