<div class="d-flex flex-column p-2">
    <div x-data class="w-full form-control form-control-sm d-flex align-items-center mb-1 p-0">
        <input x-ref="input" type="date" class="h-full pl-2 bg-transparent border-0 text-muted overflow-auto" wire:change="doDateFilterStart('{{ $index }}', $event.target.value)">
        <button x-on:click="$refs.input.value=''" wire:click="doDateFilterStart('{{ $index }}', '')"
                class="pr-2 btn btn-sm p-0 focus:outline-none ml-1" type="button" tabindex="-1">
            <x-icons.x-circle class="h-3 w-3 stroke-current text-secondary" />
        </button>
    </div>
    <div x-data class="w-full form-control form-control-sm d-flex align-items-center p-0">
        <input x-ref="input" type="date" class="h-full pl-2 bg-transparent border-0 text-muted overflow-auto" wire:change="doDateFilterEnd('{{ $index }}', $event.target.value)">
        <button x-on:click="$refs.input.value=''" wire:click="doDateFilterEnd('{{ $index }}', '')"
                class="pr-2 btn btn-sm p-0 focus:outline-none ml-1" type="button" tabindex="-1">
            <x-icons.x-circle class="h-3 w-3 stroke-current text-secondary" />
        </button>
    </div>


{{--    <div class="w-full relative flex">--}}
{{--        <input x-ref="start" class="m-1 pr-6 text-sm pt-1 flex-grow form-input" type="date"--}}
{{--            wire:change="doDateFilterStart('{{ $index }}', $event.target.value)" style="padding-bottom: 5px" />--}}
{{--        <div class="absolute inset-y-0 right-0 pr-2 flex items-center">--}}
{{--            <button x-on:click="$refs.start.value=''" wire:click="doDateFilterStart('{{ $index }}', '')" class="inline-flex text-gray-400 hover:text-red-600 focus:outline-none" tabindex="-1">--}}
{{--                <x-icons.x-circle class="h-3 w-3 stroke-current" />--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="w-full relative flex">--}}
{{--        <input x-ref="end" class="m-1 pr-6 text-sm pt-1 flex-grow form-input" type="date"--}}
{{--            wire:change="doDateFilterEnd('{{ $index }}', $event.target.value)" style="padding-bottom: 5px" />--}}
{{--            <div class="absolute inset-y-0 right-0 pr-2 flex items-center">--}}
{{--            <button x-on:click="$refs.end.value=''" wire:click="doDateFilterEnd('{{ $index }}', '')" class="inline-flex text-gray-400 hover:text-red-600 focus:outline-none" tabindex="-1">--}}
{{--                <x-icons.x-circle class="h-3 w-3 stroke-current" />--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
