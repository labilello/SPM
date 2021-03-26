{{--<div class="pagination flex rounded border border-gray-300 overflow-hidden divide-x divide-gray-300">--}}
{{--    <!-- Previous Page Link -->--}}
{{--    @if ($paginator->onFirstPage())--}}
{{--    <button class="relative inline-flex items-center px-2 py-2 bg-white text-sm leading-5 font-medium text-gray-500"--}}
{{--        disabled>--}}
{{--        <span>&laquo;</span>--}}
{{--    </button>--}}
{{--    @else--}}
{{--    <button wire:click="previousPage"--}}
{{--        class="relative inline-flex items-center px-2 py-2 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">--}}
{{--        <span>&laquo;</span>--}}
{{--    </button>--}}
{{--    @endif--}}

{{--    <div class="divide-x divide-gray-300">--}}
{{--        @foreach ($elements as $element)--}}
{{--        @if (is_string($element))--}}
{{--        <button class="-ml-px relative inline-flex items-center px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-700" disabled>--}}
{{--            <span>{{ $element }}</span>--}}
{{--        </button>--}}
{{--        @endif--}}

{{--        <!-- Array Of Links -->--}}

{{--        @if (is_array($element))--}}
{{--        @foreach ($element as $page => $url)--}}
{{--        <button wire:click="gotoPage({{ $page }})" type="button"--}}
{{--                class="-mx-1 relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 {{ $page === $paginator->currentPage() ? 'bg-gray-200' : 'bg-white' }}">--}}
{{--            {{ $page }}--}}
{{--            </button>--}}
{{--        @endforeach--}}
{{--        @endif--}}
{{--        @endforeach--}}
{{--    </div>--}}

{{--    <!-- Next Page Link -->--}}
{{--    @if ($paginator->hasMorePages())--}}
{{--    <button wire:click="nextPage" type="button"--}}
{{--        class="-ml-px relative inline-flex items-center px-2 py-2 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">--}}
{{--        <span>&raquo;</span>--}}
{{--    </button>--}}
{{--    @else--}}
{{--    <button--}}
{{--        class="-ml-px relative inline-flex items-center px-2 py-2 bg-white text-sm leading-5 font-medium text-gray-500 "--}}
{{--        disabled><span>&raquo;</span></button>--}}
{{--    @endif--}}
{{--</div>--}}

@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-end mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <button wire:click="previousPage" type="button" class="page-link" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</button>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><button wire:click="gotoPage({{ $page }})" class="page-link">{{ $page }}</button></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                <li class="page-item"><button type="button" wire:click="nextPage" class="page-link">&rsaquo;</button></li>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
