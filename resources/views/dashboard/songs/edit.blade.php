@extends('layouts.dashboard')

@section('title', 'Editar Canción')
@section('miga', 'Editar Canción')

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
        <form method="POST" action="{{ route('songs.update', $song->id) }}" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título de la Canción</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $song->title }}">
            </div>
            <div class="mb-3 d-flex flex-column">
                <label for="mp3">Mp3:</label>
                <input type="file" name="mp3" id="mp3" accept=".jpg, .jpeg, .png"
                    value="{{ asset($song->mp3) }}">
            </div>
            <div class="mb-3">
                <label for="duration" class="form-label">Duración</label>
                <input type="text" class="form-control" id="duration" name="duration"
                    value="@php $durationInSeconds = $song->duration;
                $minutes = floor($durationInSeconds / 60);
                $seconds = $durationInSeconds % 60;
                $formattedDuration = sprintf('%02d:%02d', $minutes, $seconds); @endphp {{ $formattedDuration }}"
                    disabled>
            </div>
            <div class="mb-3">
                <label for="extension" class="form-label">Extensión</label>
                <input type="text" class="form-control" id="extension" name="extension" value="{{ $song->extension }}"
                    disabled>
            </div>
            <div class="mb-3">
                <label for="reproductions" class="form-label">Reproducciones:</label>
                <input type="text" class="form-control" id="reproductions" name="reproductions" value="{{ $song->reproductions }}"
                    disabled>
            </div>
            <div class="mb-3">
                <label for="album_id" class="form-label">Album de la Canción</label>
                <select class="form-control selectpicker" data-live-search="true" name="album_id" id="album_id">
                    @foreach ($albums as $album)
                        <option value="{{ $album->id }}" {{ $song->album_id == $album->id ? 'selected' : '' }}>
                            {{ $album->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="genre_id" class="form-label">Género(s) asociados a la Canción</label>
                <select name="genre_id[]" id="genre_id" class="selectpicker form-control" multiple
                    title="Escoge uno o más Géneros">
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $song->generos->contains($genre->id) ? 'selected' : '' }}>
                            {{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="artist_id" class="form-label">Artista(s) asociados a la Canción</label>
                <select class="form-control selectpicker" id="artist_id" data-live-search="true" name="artist_id[]" multiple
                    title="Escoge uno o más Artistas">
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}"
                            {{ in_array($artist->id, $song->artistas->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $artist->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
        </form>
    </div>
@endsection

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
