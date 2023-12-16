@extends('layouts.dashboard')

@section('title', 'Mostrar Artista')
@section('miga', 'Mostrar Artista')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('artists.index') }}"><i class="bi bi-arrow-left"></i></a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <strong>Id:</strong>
            <h6>{{ $artist->id }}</h6>
        </div>
        <div class="mb-3">
            <strong>Nombre del Artista:</strong>
            <h6>{{ $artist->name }}</h6>
        </div>
        <div class="mb-3">
            <strong>Creado hace:</strong>
            <h6>{{ ucfirst($artist->created_at->diffForHumans()) }}</h6>
        </div>
    </div>
@endsection
