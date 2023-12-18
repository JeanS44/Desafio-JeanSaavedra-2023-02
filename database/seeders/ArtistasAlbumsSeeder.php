<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Database\Seeder;

class ArtistasAlbumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtener todos los álbumes y artistas
        $albums = Album::all();
        $artists = Artist::all();

        // Recorrer cada álbum
        foreach ($albums as $album) {
            // Obtener un número aleatorio de artistas (entre 1 y 3, puedes ajustar según tus necesidades)
            $numeroArtistas = rand(1, 3);

            // Obtener artistas aleatorios
            $artistasAsignados = $artists->random($numeroArtistas);

            // Vincular el álbum con los artistas
            $album->artistas()->attach($artistasAsignados->pluck('id')->toArray());
        }
    }
}
