<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear un usuario de ejemplo
        $administrador1 = User::create([
            'name' => 'Administrador',
            'surname' => 'Administrador',
            'username' => 'Administrador',
            'email' => 'administrador@administrador.com',
            'password' => Hash::make('12341234'),
        ]);

        $administrador1->assignRole('Administrador');

        // Crear un usuario de ejemplo
        $artista1 = User::create([
            'name' => 'Pablo',
            'surname' => 'Chill-E',
            'username' => 'Pablo Chill-E',
            'email' => 'pablochille@gmail.com',
            'password' => Hash::make('12341234'),
            'email_verified_at' => now(),
        ]);

        $artista1->assignRole('Artista');

        // Crear un usuario de ejemplo
        $usuario1 = User::create([
            'name' => 'Jean',
            'surname' => 'Saavedra',
            'username' => 'Jean7721',
            'email' => 'jeansaavedra65@gmail.com',
            'password' => Hash::make('12341234'),
            'email_verified_at' => now(),
        ]);

        $usuario1->assignRole('Usuario');
        $usuario1->assignRole('Administrador');
    }
}
