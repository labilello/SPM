
    <div class="accordion" id="accordionFilter">
        <div class="card">
            <div class="card-header" id="headingFilter">
                <h5 class="card-title mb-0">
                    <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="true" aria-controls="collapseFilter">
                        Filtros de busqueda
                    </button>
                </h5>
            </div>
            <div id="collapseFilter" class="was-validated collapse card-body" aria-labelledby="headingFilter" data-parent="#accordionFilter">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control pull-right" id="search" placeholder="Escriba el elemento a buscar...">
                </div>
            </div>
        </div>
    </div>

