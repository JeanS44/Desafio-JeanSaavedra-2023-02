@extends('layouts.dashboard')

@section('title', 'Mostrar Género')
@section('miga', 'Mostrar Género')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('genres.index') }}"><i class="bi bi-arrow-left"></i></a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <strong>Id:</strong>
            <h6>{{ $genre->id }}</h6>
        </div>
        <div class="mb-3">
            <strong>Nombre del Género:</strong>
            <h6>{{ $genre->name }}</h6>
        </div>
        <div class="mb-3">
            <strong>Creado hace:</strong>
            <h6>{{ ucfirst($genre->created_at->diffForHumans()) }}</h6>
        </div>
    </div>
@endsection
