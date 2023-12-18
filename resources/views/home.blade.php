@extends('layouts.landing')

@section('title', 'Página Principal')
@section('miga', 'Página Principal')

@section('content')
    <div class="grey-bg container-fluid">
        <section id="minimal-statistics">
            <div>
                <h3>Canciones</h3>
            </div>
            <audio id="reproductor" class="w-100 pt-2 pb-2" controls>
                <source src="" type="">
            </audio>
            <div class="row">
                @foreach ($songs as $song)
                    <div class="col-xl-2 col-sm-6 col-12 mb-3">
                        <div class="card h-100 text-center">
                            <div class="card-content">
                                <div class="card-body">

                                    <div class="align-self-center">
                                        <img style="width: 120px; border-radius: 50%;" class="img-rounded"
                                            src="{{ asset($song->album->cover_img) }}" alt="" srcset="">
                                    </div>
                                    <div class="media-body text-left">
                                        <strong>Título: <h6>{{ $song->title }}</h6></strong>
                                        <strong>Artistas:
                                            <h6>
                                                @foreach ($song->artistas as $artista)
                                                    {{ $artista->name }}
                                                    @if (!$loop->last)
                                                        -
                                                    @endif
                                                @endforeach
                                            </h6>
                                        </strong>
                                        <strong>
                                            Duración:
                                            <h6>
                                                @php
                                                    $durationInSeconds = $song->duration;

                                                    // Calcula los minutos y segundos
                                                    $minutes = floor($durationInSeconds / 60);
                                                    $seconds = $durationInSeconds % 60;

                                                    // Formatea el resultado
                                                    $formattedDuration = sprintf('%02d:%02d', $minutes, $seconds);
                                                @endphp
                                                {{ $formattedDuration }} Minutos
                                            </h6>
                                        </strong>
                                        <strong>
                                            Reproducciones:
                                            <h6 id="reproducciones-{{ $song->id }}">
                                                {{ $song->reproductions }}
                                            </h6>
                                        </strong>
                                        <div class="text-center mt-auto d-block">
                                            <button class="btn btn-warning"
                                                onclick="reproducir('{{ $song->mp3 }}', {{ $song->id }})">
                                                <i class="bi bi-play-circle"></i>
                                                Reproducir
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    <div class="grey-bg container-fluid">
        <section id="minimal-statistics">
            <div>
                <h3>Albums</h3>
            </div>
            <input class="form-control mr-sm-2" type="search" id="search" placeholder="Buscar Albums..."
                aria-label="Search">

            <div id="results">

            </div>
        </section>
    </div>
    {{-- <div class="grey-bg container-fluid">
        <section id="minimal-statistics">
            <div>
                <h3>Canciones</h3>
            </div>
            <div class="row">
                @foreach ($songs as $song)
                    <div class="col-xl-3 col-sm-6 col-12 mb-3">
                        <div class="card h-100 text-center">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="align-self-center">
                                            <img style="width: 80px; border-radius: 50%;" class="img-rounded"
                                                src="{{ asset($song->album->cover_img) }}" alt="" srcset="">
                                        </div>
                                        <div class="media-body text-center">
                                            <strong>Título: <h6>{{ $song->title }}</h6></strong>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div> --}}
@endsection

@push('js')
    <script>
        async function reproducir(url, cancionId) {
            var reproductor = document.getElementById('reproductor');
            reproductor.src = url;

            reproductor.addEventListener('timeupdate', async function() {
                var duracionTotal = reproductor.duration;
                var tiempoActual = reproductor.currentTime;

                var porcentajeReproduccion = (tiempoActual / duracionTotal) * 100;

                if (porcentajeReproduccion >= 5 && !getCookie('reproducido_' + cancionId)) {
                    try {
                        // Realiza la petición Ajax para incrementar el contador en el servidor
                        await $.ajax({
                            url: '/registrar-reproduccion/' + cancionId,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}'
                            }
                        });

                        // Actualiza el contador en el HTML
                        var reproduccionesElement = document.getElementById('reproducciones-' + cancionId);
                        reproduccionesElement.innerText = parseInt(reproduccionesElement.innerText) + 1;

                        // Marca la canción como reproducida para evitar múltiples incrementos
                        setCookie('reproducido_' + cancionId, 'true', 1); // La cookie expirará en 1 día
                    } catch (error) {
                        console.error('Error:', error);
                    }
                }
            });

            // Limpia el marcador cuando cambias de canción
            reproductor.addEventListener('ended', function() {
                deleteCookie('reproducido_' + cancionId);
            });

            reproductor.play();
        }

        // Funciones para manejar cookies
        function setCookie(name, value, days) {
            var expires = '';
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = '; expires=' + date.toUTCString();
            }
            document.cookie = name + '=' + value + expires + '; path=/';
        }

        function getCookie(name) {
            var nameEQ = name + '=';
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function deleteCookie(name) {
            document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    {{-- <script>
        $(document).ready(function() {
            $('#search').on('input', async function() {
                var query = $(this).val();

                try {
                    const response = await fetch(`/buscar-albums?query=${query}`);
                    const data = await response.json();

                    if ('error' in data) {
                        console.error(data.error);
                    } else {
                        displayResults(data.albums);
                    }
                } catch (error) {
                    console.error(error);
                }
            });

            function displayResults(albums) {
                var resultsContainer = $('#results');
                resultsContainer.empty();

                if (albums.length > 0) {
                    resultsContainer.append('<h2 class="mt-4">Resultados de la búsqueda</h2>');
                    resultsContainer.append('<div class="row">');

                    albums.forEach(function(album) {
                        resultsContainer.append(
                            '<div class="col-xl-3 col-sm-6 col-12 mb-3">' +
                            '    <div class="card h-100 text-center">' +
                            '        <div class="card-content">' +
                            '            <div class="card-body">' +
                            '                <div class="media">' +
                            '                    <div class="align-self-center">' +
                            '                        <img style="width: 80px; border-radius: 50%;" class="img-rounded" src="' +
                            album.cover_img + '" alt="">' +
                            '                    </div>' +
                            '                    <div class="media-body text-center">' +
                            '                        <strong>Título: <h6>' + album.title +
                            '</h6></strong>' +
                            '                    </div>' +
                            '                </div>' +
                            '            </div>' +
                            '        </div>' +
                            '    </div>' +
                            '</div>'
                        );
                    });

                    resultsContainer.append('</div>');
                } else {
                    resultsContainer.append('<p class="mt-4">No se encontraron resultados</p>');
                }
            }
        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#search').on('input', async function() {
                var query = $(this).val();

                try {
                    const response = await fetch(`/buscar-albums?query=${query}`);
                    const data = await response.json();

                    if ('error' in data) {
                        console.error(data.error);
                    } else {
                        displayResults(data.albums);
                    }
                } catch (error) {
                    console.error(error);
                }
            });

            function displayResults(albums) {
                var resultsContainer = $('#results');
                resultsContainer.empty();

                if (albums.length > 0) {
                    resultsContainer.append('<h2 class="mt-4">Resultados de la búsqueda</h2>');
                    resultsContainer.append('<div class="row">');

                    albums.forEach(function(album) {
                        resultsContainer.append(`
        <div class="col-xl-3 col-sm-6 col-12 mb-3">
            <div class="card h-100 text-center">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media">
                            <div class="align-self-center">
                                <img style="width: 80px; border-radius: 50%;" class="img-rounded" src="${album.cover_img}" alt="">
                            </div>
                            <div class="media-body text-center">
                                <strong>Título:</strong>
                                <h6>${album.title}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `);
                    });

                    resultsContainer.append('</div>');
                } else {
                    resultsContainer.append('<p class="mt-4">No se encontraron resultados</p>');
                }
            }
        });
    </script>
@endpush
