@extends('layouts.layout')

@section('content')

    <div class="container-sm">
        @if(session('status'))
            <div class="alert alert-{{ session('type_status') }}" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if( \Illuminate\Support\Facades\Auth::user()->email == 'labilello' || \Illuminate\Support\Facades\Auth::user()->email == 'mponce')
                <div class="accordion mb-2" id="accordionOne">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link btn-block text-left p-0" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Actualizar base de productos
                                </button>
                            </h5>
                        </div>

                        <form id="collapseOne" class="was-validated collapse card-body" aria-labelledby="headingOne" data-parent="#accordionOne" action="{{ route('api.updateBaseStock') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="archivo" required>
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
        @endif

        <livewire:tables.productos-table />

    </div>
@endsection
