@extends('layouts.dashboard')

@section('title', 'Editar Roles del Usuario')
@section('miga', 'Editar Roles del Usuario')

@section('addButton')
    <div class="d-flex text-center">
        <a class="btn btn-danger" href="{{ route('usersroles.index') }}"><i class="bi bi-arrow-left"></i></a>
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
        <form method="POST" action="{{ route('usersroles.update', $user->id) }}" novalidate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre del Usuario</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" disabled>
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label">Role(s) asociados al Usuario</label>
                <select name="role_id[]" id="role_id" class="selectpicker form-control" multiple
                    title="Escoge uno o más Roles">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>
                            {{ $role->name }}
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
