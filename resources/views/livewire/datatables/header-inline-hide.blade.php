<!-- Column hidden style -->
<div wire:click.prefetch="toggle('{{ $index }}')"
    class="@if($column['hidden']) d-table-cell h-12 w-3 bg-blue-100 hover:bg-blue-300 overflow-hidden @else d-none @endif"
    data-toggle="tooltip" data-placement="top" title="{{ str_replace('_', ' ', $column['label']) }}">
</div>
<!-- Column display style -->
<div
    class="@if($column['hidden']) d-none @else d-table-cell bg-light h-12 overflow-hidden align-top py-1 px-2 @endif">

    <button wire:click.prefetch="sort('{{ $index }}')"
            class="btn p-0 w-full d-flex justify-content-between">
        <span class="flex-grow-1 @if($column['align'] === 'right') text-right @elseif($column['align'] === 'center') text-center @endif">{{ str_replace('_', ' ', $column['label']) }}</span>
        <span class="">
            @if($sort === $index)
                @if($direction)
                    <x-icons.chevron-up class="h-3 w-3 text-green-600 stroke-current" />
                @else
                    <x-icons.chevron-down class="h-3 w-3 text-green-600 stroke-current" />
                @endif
            @endif
        </span>
    </button>
    <div class="w-full text-right">
        <button wire:click.prefetch="toggle('{{ $index }}')"
                class="btn btn-sm p-0">
            <x-icons.arrow-circle-left class="h-3 w-3 text-gray-300 hover:text-blue-400" />
        </button>
    </div>
</div>

{{--<div wire:click.prefetch="toggle('{{ $index }}')"--}}
{{--    class="@if($column['hidden']) position-relative d-table-cell h-12 w-3 bg-blue-100 hover:bg-blue-300 overflow-hidden align-text-top @else hide @endif"--}}
{{--    style="min-width:12px; max-width:12px;">--}}
{{--    <button class="position-relative h-12 w-3 focus:outline-none">--}}
{{--        <span--}}
{{--            class="w-32 hidden position-absolute text-uppercase            z-10 top-0 left-0 ml-3 bg-blue-300 font-medium leading-4 text-xs text-left group-hover:inline-block text-blue-700 tracking-wider transform focus:outline-none">--}}
{{--            {{ str_replace('_', ' ', $column['label']) }}--}}
{{--        </span>--}}
{{--    </button>--}}
{{--    <svg class="absolute text-blue-100 fill-current w-full inset-x-0 bottom-0"--}}
{{--        viewBox="0 0 314.16 207.25">--}}
{{--        <path stroke-miterlimit="10" d="M313.66 206.75H.5V1.49l157.65 204.9L313.66 1.49v205.26z" />--}}
{{--    </svg>--}}
{{--</div>--}}
{{--<div--}}
{{--    class="@if($column['hidden']) hidden @else relative h-12 overflow-hidden align-top flex table-cell @endif">--}}
{{--    <button wire:click.prefetch="sort('{{ $index }}')"--}}
{{--        class="w-full h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider flex justify-between items-center focus:outline-none">--}}
{{--        <span class="inline flex-grow @if($column['align'] === 'right') text-right @elseif($column['align'] === 'center') text-center @endif"">{{ str_replace('_', ' ', $column['label']) }}</span>--}}
{{--        <span class="inline text-xs text-blue-400">--}}
{{--            @if($sort === $index)--}}
{{--            @if($direction)--}}
{{--            <x-icons.chevron-up class="h-6 w-6 text-green-600 stroke-current" />--}}
{{--            @else--}}
{{--            <x-icons.chevron-down class="h-6 w-6 text-green-600 stroke-current" />--}}
{{--            @endif--}}
{{--            @endif--}}
{{--        </span>--}}
{{--    </button>--}}
{{--    <button wire:click.prefetch="toggle('{{ $index }}')"--}}
{{--        class="absolute bottom-1 right-1 focus:outline-none">--}}
{{--        <x-icons.arrow-circle-left class="h-3 w-3 text-gray-300 hover:text-blue-400" />--}}
{{--    </button>--}}
{{--</div>--}}
