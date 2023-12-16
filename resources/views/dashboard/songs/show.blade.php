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
        <div class="mb-3">
            <strong>Álbum de la Canción:</strong>
            <h6>{{ $song->albums->title }}</h6>
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
            <img src="{{ asset($song->albums->cover_img) }}" alt="{{ $song->albums->title }}"
                class="img-fluid img-thumbnail mt-2" style="width: 160px; height: 160px;">
        </div>
        <div class="mb-3">
            <strong>Creado hace:</strong>
            <h6>{{ ucfirst($song->created_at->diffForHumans()) }}</h6>
        </div>
    </div>
@endsection
