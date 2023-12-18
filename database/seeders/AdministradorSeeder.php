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
        User::create([
            'name' => 'Administrador',
            'surname' => 'Administrador',
            'username' => 'Administrador',
            'email' => 'administrador@administrador.com',
            'password' => Hash::make('12341234'),
        ])->assignRole('Administrador');

        // Crear un usuario de ejemplo
        User::create([
            'name' => 'Pablo',
            'surname' => 'Chill-E',
            'username' => 'Pablo Chill-E',
            'email' => 'artista@artista.com',
            'password' => Hash::make('12341234'),
            'email_verified_at' => now(),
        ])->assignRole('Artista');

        // Crear un usuario de ejemplo
        User::create([
            'name' => 'Jean',
            'surname' => 'Saavedra',
            'username' => 'Jean7721',
            'email' => 'oyente@oyente.com',
            'password' => Hash::make('12341234'),
            'email_verified_at' => now(),
        ])->assignRole('Oyente');
    }
}
