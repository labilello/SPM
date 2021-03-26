@extends('layouts.layout')

@section('content')
    <div class="container">
        @if(session('status'))
            <div class="alert alert-{{ session('type_status') }}" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <livewire:tables.reparaciones-pendientes-table />
    </div>
@endsection

