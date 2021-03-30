<div class="accordion mb-4" id="accordionNew">
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Ingresar nuevo producto
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse show card-body" aria-labelledby="headingOne" data-parent="#accordionNew"
        x-data x-init="$refs.show.style.display = 'none'">
            <h5 class="card-title">Datos del producto</h5>
            <div class="row">
                <div class="col-sm mb-2">
                    <div class="input-group mr-lg-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Codigo EAN</div>
                        </div>
                        <input x-ref="ean" type="text" class="form-control" placeholder="1234567891011" autofocus="true" tabindex="0" minlength="5"
                        x-on:keydown.enter="$wire.buscarProducto($refs.ean.value)
                                               .then(result => {
                                                    if( result.length == 0 ){
                                                        sinCoincidencias();
                                                        restablecerFormulario( $refs );
                                                    }
                                                    else if ( result.length == 1 ) {
                                                        mostrarProducto( result[0], $refs );
                                                    } else {
                                                        preguntarProducto( result, $refs );

                                                    }
                                               })">
                    </div>
                </div>

                <div class="col-sm">
                    <div class="input-group pb-1">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Nro. Serie</div>
                        </div>
                        <input type="text" x-ref="nroserie" class="form-control" placeholder="RF78Q5Z12G" tabindex="1" minlength="5"
                        x-on:keydown.enter="$wire.agregarProducto($refs.codunix.value, $refs.nroserie.value).then(result => {
                            if( result == 1 ) {
                                informarIngresado($refs);
                            }
                        })">
                    </div>
                    @error('nroserie') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>


            <div wire:loading.flex class="justify-content-center align-items-center my-1" id="spinner">
                <div class="spinner-border text-danger" role="status"></div>
                <span class="ml-2">Procesando informacion...</span>
            </div>


            <div id="detallesProducto" class=""  x-ref="show">
                <div class="col-xs-12 bg-light mb-2"><hr></div>

                <h5 class="card-title">Detalles del producto</h5>
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="familia">Familia</label>
                        <input x-ref="familia" type="text" class="form-control" placeholder="-" readonly tabindex="-1">
                    </div>
                    <div class="form-group col-sm-8">
                        <label for="descripcion">Descripcion</label>
                        <input x-ref="descripcion" type="text" class="form-control" id="descripcion" placeholder="-" readonly tabindex="-1">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm">
                        <label for="codigoUnix">Codigo Unix</label>
                        <input x-ref="codunix" type="text" class="form-control" name="id" id="id" placeholder="-" readonly tabindex="-1">
                        @error('prodid') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group col-sm">
                        <label for="codigoUnico">Codigo Unico</label>
                        <input x-ref="codunico" type="text" class="form-control" id="codigoUnico" placeholder="-" readonly tabindex="-1">
                    </div>

                    <div class="form-group col-sm">
                        <label for="marca">Marca</label>
                        <input x-ref="marca" type="text" class="form-control" id="marca" placeholder="-" readonly tabindex="-1">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
