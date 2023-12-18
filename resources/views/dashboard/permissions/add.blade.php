@extends('layouts.dashboard')

@section('title', 'Añadir Permiso')
@section('miga', 'Añadir Permiso')

@section('addButton')
    @can('Crear Permiso')
        <div class="d-flex text-center">
            <a class="btn btn-danger" href="{{ route('permissions.index') }}"><i class="bi bi-arrow-left"></i></a>
        </div>
    @endcan
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
        <form method="POST" action="{{ route('permissions.store') }}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Permiso</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Añadir</button>
        </form>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
