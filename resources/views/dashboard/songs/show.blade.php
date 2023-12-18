@extends('layouts.dashboard')

@section('title', 'Mostrar Canción')
@section('miga', 'Mostrar Canción')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('songs.index') }}"><i class="bi bi-arrow-left"></i></a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <strong>Id:</strong>
            <h6>{{ $song->id }}</h6>
        </div>
        <div class="mb-3">
            <strong>Título de la Canción:</strong>
            <h6>{{ $song->title }}</h6>
        </div>
        <div class="mb-3 d-flex flex-column">
            <strong>Mp3:</strong>
            <audio controls>
                <source src="{{ asset($song->mp3) }}" type="audio/ogg">
            </audio>
        </div>
        <div class="mb-3">
            <strong>Duración:</strong>
            <h6>
                @php
                    $durationInSeconds = $song->duration;

                    // Calcula los minutos y segundos
                    $minutes = floor($durationInSeconds / 60);
                    $seconds = $durationInSeconds % 60;

                    // Formatea el resultado
                    $formattedDuration = sprintf('%02d:%02d', $minutes, $seconds);
                @endphp
                {{ $formattedDuration }}
            </h6>
        </div>
        <div class="mb-3">
            <strong>Extensión de la Canción:</strong>
            <h6>{{ $song->extension }}</h6>
        </div>
        <div class="mb-3">
            <strong>Cantidad de Reproducciones:</strong>
            <h6>{{ $song->reproductions }}</h6>
        </div>
        <div class="mb-3">
            <strong>Álbum de la Canción:</strong>
            <h6>{{ $song->album->title }}</h6>
        </div>
        <div class="mb-3">
            <strong>Artista(s) de la Canción:</strong>
            <h6>
                @foreach ($song->artistas as $artista)
                    {{ $artista->name }}
                    @if (!$loop->last)
                        -
                    @endif
                @endforeach
            </h6>
        </div>
        <div class="mb-3">
            <strong>Género(s) de la Canción:</strong>
            <h6>
                @foreach ($song->generos as $genre)
                    {{ $genre->name }}
                    @if (!$loop->last)
                        -
                    @endif
                @endforeach
            </h6>
        </div>
        <div class="mb-3 d-flex flex-column">
            <strong>Cover del Álbum:</strong>
            <img src="{{ asset($song->album->cover_img) }}" alt="{{ $song->album->title }}"
                class="img-fluid img-thumbnail mt-2" style="width: 160px; height: 160px;">
        </div>
        <div class="mb-3">
            <strong>Creado hace:</strong>
            <h6>{{ ucfirst($song->created_at->diffForHumans()) }}</h6>
        </div>
    </div>
@endsection
