<?php

namespace App\Http\Controllers\Landing;

use App\Models\Song;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        $artists = Artist::all();
        $albums = Album::all();
        $songs = Song::orderByDesc('reproductions')->take(12)->get();

        return view('home', [
            'artists' => $artists,
            'songs' => $songs,
            'albums' => $albums,
        ]);
    }

    public function registrarReproduccion($cancionId)
    {
        try {
            // Encuentra la canción en la base de datos
            $cancion = Song::findOrFail($cancionId);

            // Incrementa el contador de reproducciones
            $cancion->reproductions += 1;
            $cancion->save();

            // Respuesta JSON exitosa
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Respuesta JSON en caso de error
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function buscarAlbums(Request $request)
    {
        try {
            $query = $request->input('query');

            $albums = Album::where('title', 'like', '%' . $query . '%')->get();

            return response()->json(['albums' => $albums]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
