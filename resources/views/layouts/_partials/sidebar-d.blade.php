<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-solid fa-music"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Wave <sup>SOUND</sup></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel de Administración</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Administrar
    </div>
    <!-- Nav Item - Pages Collapse Menu -->

    <li class="nav-item">
        @can('ver-boton-usuario')
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#adminUsers"
                aria-expanded="true" aria-controls="adminUsers">
                <i class="bi bi-person-circle"></i>
                <span>Usuarios</span>
            </a>
            <div id="adminUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('ver-usuario')
                        <a class="collapse-item" href="{{ route('users.index') }}">
                            <i class="bi bi-people-fill"></i>
                            Usuarios
                        </a>
                    @endcan
                </div>
            </div>
        @endcan
    </li>


    <li class="nav-item">
        @can('ver-boton-musica')
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa-solid fa-music"></i>
                <span>Música</span>
            </a>

            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('ver-artista')
                        <a class="collapse-item" href="{{ route('artists.index') }}">
                            <i class="bi bi-person-add"></i>
                            Artistas
                        </a>
                    @endcan
                    @can('ver-album')
                        <a class="collapse-item" href="{{ route('albums.index') }}">
                            <i class="bi bi-disc-fill"></i>
                            Albums
                        </a>
                    @endcan
                    @can('ver-genero')
                        <a class="collapse-item" href="{{ route('genres.index') }}">
                            <i class="bi bi-blockquote-left"></i>
                            Géneros
                        </a>
                    @endcan
                    @can('ver-cancion')
                        <a class="collapse-item" href="{{ route('songs.index') }}">
                            <i class="bi bi-file-earmark-music-fill"></i>
                            Canciones
                        </a>
                    @endcan
                    {{-- <a class="collapse-item" href="{{ route('userssongs.index') }}">
                    <i class="bi bi-headset"></i>
                    Usuario - Canción
                </a> --}}
                </div>
            </div>
        @endcan
    </li>


    <li class="nav-item">
        @can('ver-boton-roles-y-permisos')
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#rolesYPermisos"
                aria-expanded="true" aria-controls="rolesYPermisos">
                <i class="bi bi-key-fill"></i>
                <span>Roles y permisos</span>
            </a>
            <div id="rolesYPermisos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('ver-rol')
                        <a class="collapse-item" href="{{ route('roles.index') }}">
                            <i class="bi bi-person-lines-fill"></i>
                            Roles
                        </a>
                    @endcan
                    @can('ver-asignar-rol')
                        <a class="collapse-item" href="{{ route('usersroles.index') }}">
                            <i class="bi bi-plus-lg"></i>
                            Asignar Roles
                        </a>
                    @endcan
                    @can('ver-permiso')
                        <a class="collapse-item" href="{{ route('permissions.index') }}">
                            <i class="bi bi-key"></i>
                            Permisos
                        </a>
                    @endcan
                    @can('ver-asignar-permiso')
                        <a class="collapse-item" href="{{ route('rolespermissions.index') }}">
                            <i class="bi bi-ban"></i>
                            Asignar Permisos
                        </a>
                    @endcan
                </div>
            </div>
        @endcan
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>