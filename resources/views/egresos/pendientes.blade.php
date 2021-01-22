@extends('layouts.layout')

@section('content')

    <div class="container-sm">
        @if(session('status'))
            <div class="alert alert-{{ session('type_status') }}" role="alert">
                {{ session('status') }}
            </div>
        @endif

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
                    @csrf
                    <div class="row align-items-end">
                        <div class="form-group col-sm-7">
                            <label for="clave">Clave de busqueda:</label>
                            <input type="text" class="form-control" id="clave" required>
                        </div>
                        <div class="form-group col-sm-3 pl-1">
                            <label for="buscarPor">Buscar por:</label>
                            <select class="custom-select custom-select" id="buscarPor">
                                <option value="nroserie">Nro. Serie</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-2 pl-1">
                            <input type="submit" id="buscarAPI" class="btn btn-primary btn-sm w-100 mb-sm-1" value="Buscar">
                            <a href="{{ route('vista.egresos.pendientes') }}" class="btn btn-secondary btn-sm w-100">Eliminar filtros</a>
                        </div>
                        <input type="hidden" value="2" id="status">
                        <input type="hidden" value="reparaciones" id="entidad">
                    </div>
                </div>
            </div>
        </div> {{-- Filtro de tabla API - FETCH --}}

        <div class="row justify-content-center mt-4">
            <h4 class="col-12">Pendientes de egreso (<span id="totalTabla">{{ $elements->total() }}</span>)</h4>
            <div class="col">
                <table class="table table-hover table-sm table-responsive-sm border-0" id="mytable">
                    <thead>
                        <tr class="border-0">
                            <th scope="col">#</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Fecha Ingreso</th>
                            <th scope="col">Familia</th>
                            <th scope="col">Nro. Serie</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                        @foreach($elements as $repair)
                            <tr>
                                <td>{{ $repair->id }}</td>
                                <td>{{ $repair->product->descripcion }}</td>
                                <td>{{ $repair->date_in->format('d/m/Y H:i:s') }}</td>
                                <td>{{ $repair->product->familia }}</td>
                                <td>{{ $repair->nro_serie }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">{{ $elements->appends(request()->input())->links('vendor.pagination.bootstrap-4') }}</div>
                </div>
            </div>
        </div>
    </div>
    <audio id="correcto" class="d-none" controls>
        <source type="audio/mp3" src="{{ asset('src/correcto.mp3') }}">
        Your browser does not support the audio element.
    </audio>
    <audio id="error" class="d-none" controls>
        <source type="audio/mp3" src="{{ asset('src/error.mp3') }}">
        Your browser does not support the audio element.
    </audio>
@endsection
