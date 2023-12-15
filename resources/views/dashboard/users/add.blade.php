@extends('layouts.dashboard')

@section('title', 'Añadir Usuario')
@section('miga', 'Añadir Usuario')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('users.index') }}"><i class="bi bi-arrow-left"></i></a>
    </div>
@endsection

@section('content')
    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                <i class="bi bi-check2-all"></i>
                {{ session('success') }}
            </div>
        @else
            @if (session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('error') }}
                </div>
            @endif
        @endif
        <form method="POST" action="{{ route('users.store') }}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre(s)</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="surname" class="form-label">Apellido(s)</label>
                <input type="text" class="form-control" id="surname" name="surname">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password-confirm" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Añadir</button>
        </form>
    </div>
@endsection
