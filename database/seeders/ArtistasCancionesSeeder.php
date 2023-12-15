<?php

namespace Database\Seeders;

use App\Models\Song;
use App\Models\Artist;
use Illuminate\Database\Seeder;

class ArtistasCancionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener todas las canciones y géneros
        $artists = Artist::all();
        $songs = Song::all();

        // Recorrer cada canción
        foreach ($artists as $artist) {
            // Obtener un número aleatorio de géneros (entre 1 y 3, puedes ajustar según tus necesidades)
            $numeroCaniones = rand(1, 3);

            // Obtener géneros aleatorios
            $cancionesAsignadas = $songs->random($numeroCaniones);

            // Vincular la canción con los géneros
            $artist->canciones()->attach($cancionesAsignadas->pluck('id')->toArray());
        }
    }
}
