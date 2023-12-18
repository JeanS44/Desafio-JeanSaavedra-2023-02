@extends('layouts.dashboard')

@section('title', 'Asignar Permisos')
@section('miga', 'Vista Principal del Panel de Asignación de Permisos')

@section('content')
    <div class=" align-items-center justify-content-between mb-4">
        @can('ver-tabla-asignar-permiso')
            @if (session()->has('update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check2-all"></i>
                    {{ session('update') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
            @endif
            <table id="userPermissionsTable" class="display nowrap table table-striped responsive" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre del Rol</th>
                        <th>Permisos Asignados</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getRoles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }} {{ $role->surname }}</td>
                            <td>
                                @php
                                    $permissions = $role->getPermissionNames()->toArray();
                                    $visiblePermissions = array_slice($permissions, 0, 4);
                                    $remainingPermissions = count($permissions) - count($visiblePermissions);
                                @endphp
                                {{ implode(' - ', $visiblePermissions) }}
                                @if ($remainingPermissions > 0)
                                    <!-- Muestra la cantidad restante de permisos -->
                                    y {{ $remainingPermissions }} permisos más...
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-3">
                                    @can('editar-asignar-permiso')
                                        <a class="btn btn-success" href="{{ route('rolespermissions.edit', $role->id) }}">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endcan
                                    @can('mostrar-asignar-permiso')
                                        <a class="btn btn-primary" href="{{ route('rolespermissions.show', $role->id) }}">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
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
        new DataTable('#userPermissionsTable', {
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
@endpush
