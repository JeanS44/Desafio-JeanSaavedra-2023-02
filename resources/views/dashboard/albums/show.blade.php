@extends('layouts.dashboard')

@section('title', 'Mostrar Album')
@section('miga', 'Mostrar Album')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('albums.index') }}"><i class="bi bi-arrow-left"></i></a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <strong>Id:</strong>
            <h6>{{ $album->id }}</h6>
        </div>
        <div class="mb-3">
            <strong>Título del Álbum:</strong>
            <h6>{{ $album->title }}</h6>
        </div>
        <div class="mb-3">
            <strong>Artista del Álbum:</strong>
            <h6>{{ $album->artista->name }}</h6>
        </div>
        <div class="mb-3">
            <strong>Año:</strong>
            <h6>{{ $album->year }}</h6>
        </div>
        <div class="mb-3 d-flex flex-column">
            <strong>Cover del Album:</strong>
            <img src="{{ asset($album->cover_img) }}" alt="{{ $album->title }}" class="img-fluid img-thumbnail mt-2" style="width: 160px; height: 160px;">
        </div>
        <div class="mb-3">
            <strong>Creado hace:</strong>
            <h6>{{ ucfirst($album->created_at->diffForHumans()) }}</h6>
        </div>
    </div>
@endsection
