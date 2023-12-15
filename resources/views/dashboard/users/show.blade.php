@extends('layouts.dashboard')

@section('title', 'Mostrar Usuario')
@section('miga', 'Mostrar Usuario')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('users.index') }}"><i class="bi bi-arrow-left"></i></a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <strong>Id:</strong>
            <h6>{{ $user->id }}</h6>
        </div>
        <div class="mb-3">
            <strong>Nombre(s):</strong>
            <h6>{{ $user->name }}</h6>
        </div>
        <div class="mb-3">
            <strong>Apellido(s):</strong>
            <h6>{{ $user->surname }}</h6>
        </div>
        <div class="mb-3">
            <strong>Nombre de Usuario:</strong>
            <h6>{{ $user->username }}</h6>
        </div>
        <div class="mb-3">
            <strong>Correo Electrónico:</strong>
            <h6>{{ $user->email }}</h6>
        </div>
        <div class="mb-3">
            <strong>Creado hace:</strong>
            <h6>{{ ucfirst($user->created_at->diffForHumans()) }}</h6>
        </div>
    </div>
@endsection
