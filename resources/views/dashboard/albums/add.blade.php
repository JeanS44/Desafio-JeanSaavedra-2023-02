@extends('layouts.dashboard')

@section('title', 'Añadir Album')
@section('miga', 'Añadir Album')

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
        <form method="POST" action="{{ route('albums.store') }}" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Título del Álbum</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="mb-3">
                <label for="artist_id" class="form-label">Artista del Álbum</label>
                <select name="artist_id" id="artist_id" class="selectpicker form-control" data-live-search="true"
                    title="Escoge un Artista">
                    @foreach ($artists as $artist)
                        <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Año</label>
                <input type="text" class="form-control" id="year" name="year">
            </div>
            <div class="mb-3 d-flex flex-column">
                <label for="cover_img">Imagen</label>
                <input type="file" name="cover_img" id="cover_img" accept=".jpg, .jpeg, .png">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Añadir</button>
        </form>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#artist_id').selectpicker();
        });
    </script>
@endpush
