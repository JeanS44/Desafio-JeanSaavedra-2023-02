<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'ver-boton-usuario', // Listo
            'ver-boton-musica', // Listo
            'ver-boton-roles-y-permisos', // Listo

            'ver-usuario', // Listo
            'ver-artista', // Listo
            'ver-album', // Listo
            'ver-genero', // Listo
            'ver-cancion', // Listo
            'ver-rol', // Listo
            'ver-asignar-rol', // Listo
            'ver-permiso', // Listo
            'ver-asignar-permiso', // Listo

            'ver-tabla-usuario', // Listo
            'crear-usuario', // Listo
            'editar-usuario', // Listo
            'mostrar-usuario', // Listo
            'borrar-usuario', // Listo

            'ver-tabla-artista', // Listo
            'crear-artista', // Listo
            'editar-artista', // Listo
            'mostrar-artista', // Listo
            'borrar-artista', // Listo

            'ver-tabla-album', // Listo
            'crear-album', // Listo
            'editar-album', // Listo
            'mostrar-album', // Listo
            'borrar-album', // Listo

            'ver-tabla-genero', // Listo
            'crear-genero', // Listo
            'editar-genero', // Listo
            'mostrar-genero', // Listo
            'borrar-genero', // Listo

            'ver-tabla-cancion', // Listo
            'crear-cancion', // Listo
            'editar-cancion', // Listo
            'mostrar-cancion', // Listo
            'borrar-cancion', // Listo

            'ver-tabla-rol', // Listo
            'crear-rol', // Listo
            'editar-rol', // Listo
            'mostrar-rol', // Listo
            'borrar-rol', // Listo

            'ver-tabla-asignar-rol', // Listo
            'editar-asignar-rol', // Listo
            'mostrar-asignar-rol', // Listo

            'ver-tabla-permiso', // Listo
            'crear-permiso', // Listo
            'editar-permiso', // Listo
            'mostrar-permiso', // Listo
            'borrar-permiso', // Listo

            'ver-tabla-asignar-permiso', // Listo
            'editar-asignar-permiso', // Listo
            'mostrar-asignar-permiso', // Listo
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission])->syncRoles(['Administrador']);
        }
    }
}
