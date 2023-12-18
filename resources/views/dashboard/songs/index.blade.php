@extends('layouts.dashboard')

@section('title', 'Canciones')
@section('miga', 'Vista Principal del Panel de Canciones')

@section('addButton')
    @can('crear-cancion')
        <div class="d-flex text-center">
            <a class="btn btn-primary" href="{{ route('songs.create') }}"><i class="bi bi-plus"></i></a>
        </div>
    @endcan
@endsection

@section('content')
    <div class=" align-items-center justify-content-between mb-4">
        @can('ver-tabla-cancion')
            @if (session()->has('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-trash3"></i>
                    {{ session('delete') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            @elseif (session()->has('update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check2-all"></i>
                    {{ session('update') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            @elseif (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check2-all"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            @elseif (session()->has('alert'))
                <div class="alert alert-success alert-warning fade show" role="alert">
                    <i class="bi bi-exclamation-triangle"></i>
                    {{ session('alert') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            @endif
            <table id="songsTable" class="display nowrap table table-striped responsive" style="width:100%">
                <thead>
                    <tr>
                        <th><strong>Id</strong></th>
                        <th><strong>Título de la Canción</strong></th>
                        <th><strong>Mp3</strong></th>
                        <th><strong>Duración</strong></th>
                        <th><strong>Extensión</strong></th>
                        <th><strong>Reproducciones</strong></th>
                        <th><strong>Álbum de la Canción</strong></th>
                        <th><strong>Artista(s) de la Canción</strong></th>
                        <th><strong>Género(s) de la Canción</strong></th>
                        <th><strong>Imagen</strong></th>
                        <th><strong>Fecha de Creación</strong></th>
                        <th><strong>Acción</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($songs as $song)
                        <tr>
                            <td>{{ $song->id }}</td>
                            <td>{{ $song->title }}</td>
                            <td>
                                <audio controls onplay="pauseOthers(this);">
                                    <source src="{{ asset($song->mp3) }}" type="audio/ogg">
                                </audio>
                            </td>
                            <td>
                                @php
                                    $durationInSeconds = $song->duration;

                                    // Calcula los minutos y segundos
                                    $minutes = floor($durationInSeconds / 60);
                                    $seconds = $durationInSeconds % 60;

                                    // Formatea el resultado
                                    $formattedDuration = sprintf('%02d:%02d', $minutes, $seconds);
                                @endphp
                                {{ $formattedDuration }}</td>
                            <td>{{ $song->extension }}</td>
                            <td>{{ $song->reproductions }}</td>
                            <td>{{ $song->album->title }}</td>
                            <td>
                                @foreach ($song->artistas as $artista)
                                    {{ $artista->name }}
                                    @if (!$loop->last)
                                        -
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($song->generos as $genre)
                                    {{ $genre->name }}
                                    @if (!$loop->last)
                                        -
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <img src="{{ asset($song->album->cover_img) }}" alt="{{ $song->album->title }}"
                                    class="img-fluid img-thumbnail mt-2" style="width: 70px; height: 70px;">
                            </td>
                            <td>{{ $song->created_at }}</td>
                            <td>
                                <div class="d-flex gap-3 text-center">
                                    @can('editar-cancion')
                                        <a class="btn btn-success" href="{{ route('songs.edit', $song->id) }}">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('mostrar-cancion')
                                        <a class="btn btn-primary" href="{{ route('songs.show', $song) }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    @endcan
                                    @can('borrar-cancion')
                                        <form action="{{ route('songs.destroy', $song->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash3">
                                                </i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endcan
    </div>
@endsection

@push('css')
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
@endpush

@push('datatables')
    <script src="https://code.jquery.com/jquery-3.7.0.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js" type="text/Javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" type="text/Javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/Javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js" type="text/Javascript"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js" type="text/Javascript">
    </script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js" type="text/Javascript">
    </script>
    <script>
        new DataTable('#songsTable', {
            order: [5, 'desc'],
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-CL.json',
            },
            dom: "<'row'<'col-sm-4'l><'col-sm-4'B><'col-sm-4'fr>>" +
                "<'row'<'col-sm-12 mt-4 mb-4't>>" +
                "<'row'<'col-sm-6'i><'col-sm-6'p>>",
            buttons: {
                buttons: [{
                        extend: 'copy',
                        text: '<i class="bi bi-clipboard-fill"></i>',
                        titleAttr: 'Copiar',
                        className: 'btn btn-secondary'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="bi bi-file-earmark-excel-fill"></i>',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="bi bi-file-earmark-pdf-fill"></i>',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        text: '<i class="bi bi-printer-fill"></i>',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-info'
                    },
                    {
                        extend: 'colvis',
                        text: 'Filtrar Columnas',
                    }
                ]
            },
            lengthMenu: [5, 10, 25, 50]
        });
    </script>
    <script type="text/javascript">
        function pauseOthers(element) {
            $("audio").not(element).each(function(index, audio) {
                audio.pause();
            })
        }
    </script>
@endpush
