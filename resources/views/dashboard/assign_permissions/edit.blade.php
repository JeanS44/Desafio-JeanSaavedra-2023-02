@extends('layouts.dashboard')

@section('title', 'Editar Permisos de los Roles')
@section('miga', 'Editar Permisos de los Roles')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('rolespermissions.index') }}"><i class="bi bi-arrow-left"></i></a>
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
        <form method="POST" action="{{ route('rolespermissions.update', $role->id) }}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Rol</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}"
                    disabled>
            </div>
            <div class="mb-3">
                <label for="permission_id" class="form-label">Permisos asociados al Rol</label>
                <select name="permission_id[]" id="permission_id" class="selectpicker form-control" multiple
                    title="Escoge uno o más Permisos" data-actions-box="true">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}"
                            {{ $role->permissions->contains($permission->id) ? 'selected' : '' }}>
                            {{ $permission->name }}
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
            $('#role_id').selectpicker();
        });
    </script>
@endpush
