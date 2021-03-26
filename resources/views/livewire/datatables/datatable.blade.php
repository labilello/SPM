<div>
    @if($beforeTableSlot)
        <div class="mt-8">
            @include($beforeTableSlot)
        </div>
    @endif


    <div class="position-relative">
        <!-- Searching spinner -->
        <div wire:loading.flex class="align-items-center justify-content-lg-end justify-content-center mb-2">
            <div class="spinner-border text-danger spinner-border-sm mr-2" role="status" aria-hidden="true"></div>
            <strong>Actualizando datos...</strong>
        </div>

        <div class="row justify-content-between align-items-center mb-3 flex-column-reverse flex-lg-row">
            <div class="d-lg-flex align-items-center col-lg-7 mt-1 mt-lg-0">

                <!-- INPUT SEARCH -->
                @if($this->searchableColumns()->count())
                    <div class="input-group rounded-lg shadow-sm ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" stroke="currentColor" fill="none">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                        </div>
                        <input wire:model.debounce.500ms="search" type="text" class="form-control" aria-label="Search" placeholder="Buscar por {{ strtolower( $this->searchableColumns()->map->label->join(', ') )}}">
                    </div>
                @endif
            </div>
            <!-- / -->

            <!-- LOADING -->
            <div class="d-flex flex-wrap col-12 col-lg-5 justify-content-between justify-content-lg-end">

                <!-- EXPORTABLE BUTTON -->
                @if($exportable)
                    <div x-data="{ init() {
                                window.livewire.on('startDownload', link => window.open(link,'_blank'))
                            } }" x-init="init" class="ml-lg-2 mb-1 mb-lg-0">
{{--                        <button  class="d-flex align-items-center px-3 bg-white text-uppercase     space-x-2 border border-green-400 rounded-md  text-green-500 text-xs leading-4 font-medium tracking-wider hover:bg-green-200 focus:outline-none"><span>Export</span>--}}
{{--                            <x-icons.excel class="m-2" /></button>--}}
                        <button wire:click="export" type="button" class="btn btn-outline-primary">
                            <span>Exportar</span>
                            <x-icons.excel class="" />
                        </button>
                    </div>
                @endif
                <!-- SHOW/HIDE COLUMNS BUTTON AND DROP -->
                @if($hideable === 'select')
                    @include('datatables::hide-column-multiselect')
                @endif
            </div>
        </div>

        <!-- No lo se -->
        @if($hideable === 'buttons')
        <div class="p-2 row       grid grid-cols-8 gap-2">
            @foreach($this->columns as $index => $column)
                <button wire:click.prefetch="toggle('{{ $index }}')" class="px-3 py-2 rounded text-white text-xs focus:outline-none
                {{ $column['hidden'] ? 'bg-blue-100 hover:bg-blue-300 text-blue-600' : 'bg-blue-500 hover:bg-blue-800' }}">
                    {{ $column['label'] }}
                </button>
            @endforeach
        </div>
        @endif
        <!-- / -->

        <!-- CONTAINER TABLE -->
        <div class="rounded-lg shadow-lg bg-white overflow-x-scroll scrollbar-w-2 scrollbar-track-gray-lighter scrollbar-thumb-rounded scrollbar-thumb-gray     max-w-screen">
            <div class="rounded-lg                                  @unless($this->hidePagination) rounded-b-none @endif">
                <!-- TABLE DESIGN -->
                <div class="d-table align-middle w-full          min-w-full">
                    @unless($this->hideHeader)
                        <div class="d-table-row divide-x divide-gray-200">
                            <!-- HEADER -->
                            @foreach($this->columns as $index => $column)
                                @if($hideable === 'inline')
                                    <!-- Column hideable (with arrow) -->
                                    @include('datatables::header-inline-hide', ['column' => $column, 'sort' => $sort])
                                    <!-- / -->
                                @elseif($column['type'] === 'checkbox')
                                    <!-- Column Checkbox -->
                                    <div class="position-relative d-table-cell h-12 w-48 overflow-hidden align-top px-4 py-2 border-bottom border-info text-left font-weight-bold text-black-50 text-uppercase d-flex align-items-center          border-gray-200 bg-gray-50 text-xs leading-4 text-gray-500 tracking-wider flex items-center focus:outline-none">
                                        <div class="px-3 py-1 rounded @if(count($selected)) bg-orange-400 bg-primary @else bg-secondary @endif text-white text-center">
                                            {{ count($selected) }}
                                        </div>
                                    </div>
                                @else
                                    <!-- Columns unhideable -->
                                    @include('datatables::header-no-hide', ['column' => $column, 'sort' => $sort])
                                    <!-- / -->
                                @endif
                            @endforeach
                        </div>
                        <!-- Filtros -->
                        <div class="d-table-row divide-x divide-blue-200 bg-blue-100">
                            @foreach($this->columns as $index => $column)
                                @if($column['hidden'])
                                    @if($hideable === 'inline')
                                        <div class="d-table-cell w-5 overflow-hidden align-top bg-blue-100"></div>
                                    @endif
                                @elseif($column['type'] === 'checkbox')
                                    <div class="w-32 overflow-hidden align-top bg-blue-100 px-2 py-3 border-bottom border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 text-uppercase tracking-wider d-flex h-full flex-column align-items-center space-y-2 focus:outline-none">
                                        <div>SELECCIONAR TODO</div>
                                        <div>
                                            <input type="checkbox" wire:click="toggleSelectAll" @if(count($selected) === $this->results->total()) checked @endif class="form-checkbox mt-1 h-4 w-4 text-blue-600 transition duration-150 ease-in-out" />
                                        </div>
                                    </div>
                                @else
                                    <div class="d-table-cell overflow-hidden align-top">
                                        @isset($column['filterable'])
                                            @if( is_iterable($column['filterable']) )
                                                <div wire:key="{{ $index }}">
                                                    @include('datatables::filters.select', ['index' => $index, 'name' => $column['label'], 'options' => $column['filterable']])
                                                </div>
                                            @else
                                                <div wire:key="{{ $index }}">
                                                    @include('datatables::filters.' . ($column['filterView'] ?? $column['type']), ['index' => $index, 'name' => $column['label']])
                                                </div>
                                            @endif
                                        @endisset
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    @forelse($this->results as $result)
                        <div class="d-table-row p-1 divide-gray-100 {{ isset($result->checkbox_attribute) && in_array($result->checkbox_attribute, $selected) ? 'bg-orange-100' : ($loop->even ? 'bg-gray-100' : 'bg-gray-50') }}">
                            @foreach($this->columns as $column)
                                @if($column['hidden'])
                                    @if($hideable === 'inline')
                                        <div class="d-table-cell w-5 overflow-hidden align-top"></div>
                                    @endif
                                @elseif($column['type'] === 'checkbox')
                                    @include('datatables::checkbox', ['value' => $result->checkbox_attribute])
                                @else
                                    <div class="px-3 py-1 whitespace-no-wrap text-sm leading-5 text-gray-900 d-table-cell @if($column['align'] === 'right') text-right @elseif($column['align'] === 'center') text-center @else text-left @endif">
                                        {!! $result->{$column['name']} !!}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @empty
                        <p class="p-3 text-lg text-teal-600">
                            No se han encontrado elementos
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
        @unless($this->hidePagination)
            {{-- check if there is any data --}}
            @if($this->results[1])
            <div class="py-2 rounded-lg border-bottom border-gray-200 bg-white             max-w-screen border-b">
                <div class="d-flex justify-content-center d-lg-none mb-2">
                    <span class="">{{ $this->results->links('datatables::tailwind-simple-pagination') }}</span>
                </div>

                <div class="row align-items-center justify-content-between mx-1">
                    <div class="col col-lg-2  d-flex align-items-center">
                        <select name="perPage" class="form-control form-control-sm" wire:model="perPage">
                            <option value="10">10 por pagina</option>
                            <option value="25">25 por pagina</option>
                            <option value="50">50 por pagina</option>
                            <option value="100">100 por pagina</option>
                            <option value="99999999">Todos</option>
                        </select>
                    </div>

                    <div class="d-none col d-lg-flex justify-content-center">
                        <span>{{ $this->results->links('datatables::tailwind-pagination') }}</span>
                    </div>

                    <div class="col col-lg-3 d-flex justify-content-end text-gray-600">
                        Resultados {{ $this->results->firstItem() }} - {{ $this->results->lastItem() }} de
                        {{ $this->results->total() }}
                    </div>
                </div>
            </div>
            @endif
        @endif
{{--    </div>--}}
    @if($afterTableSlot)
    <div class="mt-8">
        @include($afterTableSlot)
    </div>
    @endif
</div>
