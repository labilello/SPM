@extends('layouts.layout')

@section('content')

    <div class="container-sm">

        <div class="accordion mb-2" id="accordionOne">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Actualizar base de productos
                        </button>
                    </h5>
                </div>

                <form id="collapseOne" class="was-validated collapse card-body" aria-labelledby="headingOne" data-parent="#accordionOne" action="{{ route('home') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(session('status'))
                        <div class="alert alert-{{ session('type_status') }}" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" required>
                        <label class="custom-file-label" for="customFile">Elija un archivo .csv</label>
                    </div>
                    <div class="row mt-sm-2">
                        <div class="col">
                            <input class="btn btn-primary" type="submit" value="Enviar">
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                    <input type="text" class="col-12 form-control">
                </div>
            </div>
        </div>


        <div class="row justify-content-center mt-4">
            <h4 class="col-12">Lista de productos</h4>
            <div class="col">
                <table class="table table-hover table-sm table-responsive-sm border-0">
                    <thead>
                        <tr class="border-0">
                            <th scope="col">Cod. Unix</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Familia</th>
                            <th scope="col">EAN</th>
                            <th scope="col">Cod. Unico</th>
                            <th scope="col">Costo Reposicion</th>
                            <th scope="col">IVA</th>
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->codigo_unix }}</td>
                                <td>{{ $product->descripcion }}</td>
                                <td>{{ $product->marca }}</td>
                                <td>{{ $product->familia }}</td>
                                <td>{{ $product->codigo_barras }}</td>
                                <td>{{ $product->codigo_unico }}</td>
                                <td>${{ $product->costo_reposicion }}</td>
                                <td>{{ $product->iva_percent }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">{{ $products->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
