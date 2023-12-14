<?php

namespace Database\Seeders;

use App\Models\Song;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
class CancionesGenerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener todas las canciones y géneros
        $canciones = Song::all();
        $generos = Genre::all();

        // Recorrer cada canción
        foreach ($canciones as $cancion) {
            // Obtener un número aleatorio de géneros (entre 1 y 3, puedes ajustar según tus necesidades)
            $numeroGeneros = rand(1, 3);

            // Obtener géneros aleatorios
            $generosAsignados = $generos->random($numeroGeneros);

            // Vincular la canción con los géneros
            $cancion->generos()->attach($generosAsignados->pluck('id')->toArray());
        }
    }
}
