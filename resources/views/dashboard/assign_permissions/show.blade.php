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
            <strong>Id:</strong>
            <h6>{{ $role->id }}</h6>
        </div>
        <div class="mb-3">
            <strong>Permisos(s) Asignados:</strong>
            <h6>
                @forelse ($role->permissions as $permission)
                    {{ $permission->name }}
                    @unless ($loop->last)
                        -
                    @endunless
                @empty
                    No se han asignado permisos.
                @endforelse
            </h6>
        </div>
    </div>
@endsection
