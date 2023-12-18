@extends('layouts.dashboard')

@section('title', 'Mostrar Rol')
@section('miga', 'Mostrar Rol')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('roles.index') }}"><i class="bi bi-arrow-left"></i></a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <strong>Id:</strong>
            <h6>{{ $role->id }}</h6>
        </div>
        <div class="mb-3">
            <strong>Nombre del Rol:</strong>
            <h6>{{ $role->name }}</h6>
        </div>
    </div>
@endsection
