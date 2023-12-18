@extends('layouts.dashboard')

@section('title', 'Mostrar Permiso')
@section('miga', 'Mostrar Permiso')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('permissions.index') }}"><i class="bi bi-arrow-left"></i></a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <strong>Id:</strong>
            <h6>{{ $permission->id }}</h6>
        </div>
        <div class="mb-3">
            <strong>Nombre del Permiso:</strong>
            <h6>{{ $permission->name }}</h6>
        </div>
    </div>
@endsection
