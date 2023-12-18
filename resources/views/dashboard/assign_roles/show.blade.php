@extends('layouts.dashboard')

@section('title', 'Mostrar Roles del Usuario')
@section('miga', 'Mostrar Roles del Usuario')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('rolespermissions.index') }}"><i class="bi bi-arrow-left"></i></a>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="mb-3">
            <strong>Id Usuario:</strong>
            <h6>{{ $user->id }}</h6>
        </div>
        <div class="mb-3">
            <strong>Nombre(s):</strong>
            <h6>{{ $user->name }}</h6>
        </div>
        <div class="mb-3">
            <strong>Apellido(s):</strong>
            <h6>{{ $user->surname }}</h6>
        </div>
        <div class="mb-3">
            <strong>Nombre de Usuario:</strong>
            <h6>{{ $user->username }}</h6>
        </div>
        <div class="mb-3">
            <strong>Role(s) Asignados:</strong>
            <h6>
                @forelse ($user->roles as $role)
                    {{ $role->name }}
                    @unless (!$loop->last)
                        -
                    @endforelse
                @empty
                    No se han asignado roles.
                @endforelse
            </h6>
        </div>
    </div>
@endsection
