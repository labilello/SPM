@extends('layouts.layout')

@section('content')

    <div class="container-sm">
        @if(session('status'))
            <div class="alert alert-{{ session('type_status') }}" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="accordion mb-4" id="accordionNew">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Registrar nueva PC
                        </button>
                    </h5>
                </div>


                <form id="collapseOne" class="collapse show card-body" aria-labelledby="headingOne" data-parent="#accordionNew" action="{{ route('accion.makepc.nuevo') }}" method="POST">
                    @csrf
                    <h5 class="card-title" >Detalle del registro</h5>
                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <div class="input-group mr-lg-2">
                                <div class="input-group-prepend" style="width: 9rem">
                                    <div class="input-group-text w-100">Número de Venta</div>
                                </div>
                                <input type="text" id="NV" name="NV" maxlength="9" class="form-control" required @isset($element) value="{{ $element->NV }}" @endisset>
                            </div>
                        </div>

                        @isset($element)
                            <div class="col-lg-6 mb-2">
                                <div class="input-group">
                                    <div class="input-group-prepend" style="width: 9rem">
                                        <div class="input-group-text w-100">Número interno</div>
                                    </div>
                                    <input type="text" class="form-control bg-transparent h-auto" aria-label="identificador" aria-describedby="button-addon2" value="{{ $element->id }}" readonly>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger btn-copy js-tooltip js-copy" data-toggle="tooltip" data-placement="bottom" data-copy="{{ $element->id }}" title="Copiar al portapapeles!" id="button-addon2">
                                                <!-- icon from google's material design library -->
                                            <svg class="icon" fill="white" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="22" height="22" viewBox="0 0 22 22"><path d="M17,9H7V7H17M17,13H7V11H17M14,17H7V15H14M12,3A1,1 0 0,1 13,4A1,1 0 0,1 12,5A1,1 0 0,1 11,4A1,1 0 0,1 12,3M19,3H14.82C14.4,1.84 13.3,1 12,1C10.7,1 9.6,1.84 9.18,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3Z" /></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endisset
                    </div>

                    <div class="col-12 bg-transparent mb-2"><hr></div>
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0" >Registro de partes</h5>
                        <small class="text-danger d-none" id="form-error">Debe completar tipo de parte y numero de serie!</small>
                    </div>
                    <small class="d-block text-muted mr-2 text-wrap mb-2">En caso de ingresar el numero de serie manualmente, hagalo tal cual se indica en la etiqueta respetando mayusculas y minusculas.</small>

                    <div class="row">
                        <div class="col-12 mb-2">
                            <div class="input-group">
                                <select id="tipoParte" class="col-5 col-lg-3 form-control form-select mr-1" aria-label="Tipo de parte" tabindex="1" onkeypress="insertarParte(event)">
                                    <option value="" selected disabled>Tipo de Parte..</option>
                                    <option>Motherboard</option>
                                    <option>Procesador</option>
                                    <option>Fuente de Alimentación</option>
                                    <option>Memoria RAM</option>
                                    <option>SDD</option>
                                    <option>HDD</option>
                                    <option>Placa de Video</option>
                                    <option>No definido</option>
                                </select>

                                <input type="text" id="nroSerie" maxlength="15" class="col-7 form-control" onkeypress="insertarParte(event)" tabindex="2">
                            </div>
                        </div>
                    </div>

                    <h5 class="card-title" >Listado de partes registradas</h5>
                    <div class="row" id="listaPartes">
                        @isset($element)
                            @foreach($element->parts as $n=>$part)
                                <div class="col-12 col-lg-6 row justify-content-between align-items-center mb-2 list-element">
                                    <input type="text" name="data[{{ $n }}][part]" value="{{ $part['part'] }}" class="col-4 col-lg-5 text-truncate border-0 bg-transparent" readonly tabindex="-1">
                                    <input type="text" maxlength="15" name="data[{{ $n }}][serie]" value="{{ $part['serie'] }}" class="col border-top-0 border-left-0 border-right-0 border-success border-2 pl-2 serie" required>
                                    <button type="button" class="btn-sm btn-danger col-1 ml-4" onclick="eliminarParent(event)">&cross;</button>
                                </div>
                            @endforeach
                        @endisset
                    </div>

                    <div class="col-12 bg-transparent mb-2"><hr></div>

                    <div class="row justify-content-end mt-2">
                        @isset($element)
                            <div class="col-sm-12 col-lg-3 mb-2">
                                <a class="btn btn-block btn-danger" href="{{ route('accion.makepc.imprimir', ['makepc' => $element]) }}">Imprimir etiqueta</a>
                                <small class="d-block text-muted text-wrap">Generar e imprimir la lista de componentes del equipo en etiquetas autoadhesivas.</small>
                            </div>

                            <div class="col-sm-12 col-lg-3 mb-2">
                                <input class="btn btn-block btn-success" name="action" type="button" value="Registrar cambio" onclick="enviarFormularioMakePC(this,0)">
                                <small class="d-block text-muted text-wrap mt-1">Registrar el cambio de alguno de los componentes del equpo por cambio en garantia u otro motivo similar.</small>
                            </div>

                            <div class="col-sm-12 col-lg-3 mb-2">
                                <input class="btn btn-block btn-primary" name="action" type="button" value="Editar esta PC" onclick="enviarFormularioMakePC(this,1)">
                                <small class="d-block text-muted text-wrap mt-1">Actualizar la lista de componentes del equipo debido a un error al escribir el detalle de alguno de ellos.</small>
                            </div>
                        @else
                            <div class="col-sm-12 col-lg-3 mb-2">
                                <input class="btn btn-block btn-primary" name="action" type="button" value="Registrar nueva PC" onclick="enviarFormularioMakePC(this,0)">
                                <small class="d-block text-muted text-wrap mt-1">Registrar la lista de componentes del armado de nuevo equipo.</small>
                            </div>
                        @endisset
                    </div>
                    <input type="hidden" id="_method" name="_method" value="">
                </form>
            </div>
        </div>
    </div>
@endsection
