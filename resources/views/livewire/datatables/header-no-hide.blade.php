@if($column['hidden'])
@else
    <div
        class="bg-gray-50 d-table-cell overflow-hidden align-top py-2 px-2 border-bottom border-gray-200 border-right">
        <button wire:click.prefetch="sort('{{ $index }}')"
                class="btn p-0 h-full w-full d-flex justify-content-center text-left font-weight-bold text-muted text-uppercase @if($column['align'] === 'right') d-flex justify-content-end @elseif($column['align'] === 'center') d-flex justify-content-center @endif">
            <span class="flex-grow-0 mr-2 @if($column['align'] === 'right') text-right @elseif($column['align'] === 'center') text-center @endif">
                {{ str_replace('_', ' ', $column['label']) }}
            </span>
            <span class="">
            @if($sort === $index)
                @if($direction)
                    <x-icons.chevron-up wire:loading.remove class="h-3 w-3 text-green-600 stroke-current text-success" />
                @else
                    <x-icons.chevron-down wire:loading.remove class="h-3 w-3 text-green-600 stroke-current text-success" />
                @endif
            @endif
            </span>
        </button>
    </div>

{{--<div class="relative table-cell h-12 overflow-hidden align-top">--}}
{{--    <button wire:click.prefetch="sort('{{ $index }}')" class="w-full h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex items-center focus:outline-none @if($column['align'] === 'right') flex justify-end @elseif($column['align'] === 'center') flex justify-center @endif">--}}
{{--        <span class="inline ">{{ str_replace('_', ' ', $column['label']) }}</span>--}}
{{--        <span class="inline text-xs text-blue-400">--}}
{{--            @if($sort === $index)--}}
{{--            @if($direction)--}}
{{--            <x-icons.chevron-up wire:loading.remove class="h-6 w-6 text-green-600 stroke-current" />--}}
{{--            @else--}}
{{--            <x-icons.chevron-down wire:loading.remove class="h-6 w-6 text-green-600 stroke-current" />--}}
{{--            @endif--}}
{{--            @endif--}}
{{--        </span>--}}
{{--    </button>--}}
{{--</div>--}}
@endif
