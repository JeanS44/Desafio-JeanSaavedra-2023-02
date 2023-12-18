@extends('layouts.dashboard')

@section('title', 'Añadir Canción')
@section('miga', 'Añadir Canción')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('songs.index') }}"><i class="bi bi-arrow-left"></i></a>
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
        <form method="POST" action="{{ route('songs.store') }}" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título de la Cancion</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3 d-flex flex-column">
                <label for="mp3">Cancion MP3</label>
                <input type="file" name="mp3" id="mp3" accept="audio/*">
            </div>
            <div class="mb-3">
                <label for="album_id" class="form-label">Album de la Canción</label>
                <select name="album_id" id="album_id" class="selectpicker form-control " data-live-search="true"
                     title="Escoge un Álbum">
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}">{{ $album->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="genre_id" class="form-label">Género(s) asociados a la Canción</label>
                <select name="genre_id[]" id="genre_id" class="selectpicker form-control" multiple
                     title="Escoge uno o más Géneros">
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="artist_id" class="form-label">Artista(s) asociados a la Canción</label>
                <select name="artist_id[]" id="artist_id" class="selectpicker form-control" multiple
                     title="Escoge uno o más Artistas">
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Añadir</button>
        </form>
    </div>
@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#album_id').selectpicker();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#genre_id').selectpicker();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#artist_id').selectpicker();
        });
    </script>
@endpush
