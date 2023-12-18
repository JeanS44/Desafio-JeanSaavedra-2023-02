@extends('layouts.dashboard')

@section('title', 'Editar Rol')
@section('miga', 'Editar Rol')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('roles.index') }}"><i class="bi bi-arrow-left"></i></a>
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
        <form method="POST" action="{{ route('roles.update', $role->id) }}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Rol</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
        </form>
    </div>
@endsection
