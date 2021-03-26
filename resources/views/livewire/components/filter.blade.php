<div class="accordion" id="accordionFilter">
    <div class="card">
        <div class="card-header" id="headingFilter">
            <h5 class="card-title mb-0">
                <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
                    Filtros de busqueda
                </button>
            </h5>
        </div>
        <div id="collapseFilter" class="collapse card-body" aria-labelledby="headingFilter" data-parent="#accordionFilter">
            <div class="row align-items-end">
                <div class="col-md-10 col-12">
                    <div class="row">
                        <div class="form-group col-12 col-md-8">
                            <label for="clave">Clave de busqueda:</label>
                            <input type="text" class="form-control" wire:model.defer="key">
                        </div>
                        <div class="form-group col-12 col-md-4 pl-md-1">
                            <label for="buscarPor">Buscar por:</label>
                            <select class="custom-select custom-select" wire:model.defer="searchFor">
                                <option value="" selected>-- Sin filtros --</option>
                                @foreach($searchForFields as $field)
                                    <option value="{{ $field['name'] }}">{{ $field['title'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 d-md-none bg-transparent mb-2"><hr></div>

                        <div class="form-group col-12 col-md-4">
                            <label for="clave">Fecha desde:</label>
                            <input type="date" class="form-control" wire:model.defer="datefrom">
                        </div>
                        <div class="form-group col-12 col-md-4">
                            <label for="clave">Fecha hasta:</label>
                            <input type="date" class="form-control" wire:model.defer="dateto">
                        </div>
                        <div class="form-group col-12 col-md-4 pl-md-1">
                            <label for="buscarPor">Buscar por:</label>
                            <select class="custom-select custom-select" wire:model.defer="searchForDate">
                                <option value="" selected>-- Sin filtros --</option>
                                @foreach($searchForDateFields as $field)
                                    <option value="{{ $field['name'] }}">{{ $field['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group col-12 col-md-2 pl-md-1">
                    <button type="button" wire:click="search" class="btn btn-primary btn-sm w-100 mb-1">Buscar</button>
                    <button type="button" wire:click="deleteFilter" class="btn btn-secondary btn-sm w-100">Eliminar Filtros</button>
                </div>
            </div>
        </div>
    </div>
</div>

