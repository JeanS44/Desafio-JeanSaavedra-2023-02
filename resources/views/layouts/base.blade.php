<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wavesound | @yield('title')</title>
    {{-- Bootstrap --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    @yield('content')
</body>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@stack('js')

</html>
