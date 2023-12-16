@extends('layouts.dashboard')

@section('title', 'Editar Album')
@section('miga', 'Editar Album')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('albums.index') }}"><i class="bi bi-arrow-left"></i></a>
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
        <form method="POST" action="{{ route('albums.update', $album->id) }}" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título del Album</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $album->title }}">
            </div>
            <div class="mb-3">
                <label for="artist_id" class="form-label">Artista del Álbum</label>
                <select class="form-control selectpicker" data-live-search="true" name="artist_id" id="artist_id">
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}" {{ $album->artist_id == $artist->id ? 'selected' : '' }}>
                            {{ $artist->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Año</label>
                <input type="text" class="form-control" id="year" name="year" value="{{ $album->year }}">
            </div>
            <div class="mb-3 d-flex flex-column">
                <label for="cover_img">Imagen:</label>
                <img src="{{ asset($album->cover_img) }}" alt="{{ $album->title }}" class="img-fluid img-thumbnail"
                    style="width: 120px; height: 120px;">
                <input class="mt-3" type="file" name="cover_img" id="cover_img" accept=".jpg, .jpeg, .png"
                    value="{{ asset($album->cover_img) }}">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
        </form>
    </div>
@endsection
