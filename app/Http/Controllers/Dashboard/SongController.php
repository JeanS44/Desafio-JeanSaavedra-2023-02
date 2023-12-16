<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Song;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::with('album')->latest()->get();

        return view('dashboard.songs.index', [
            'songs' => $songs,
        ]);
    }

    public function create()
    {
        $albums = Album::all();
        $genres = Genre::all();
        $artists = Artist::all();

        return view('dashboard.songs.add', [
            'albums' => $albums,
            'genres' => $genres,
            'artists' => $artists,
        ]);
    }

    public function store(Request $request)
    {
        $artistsId = $request->input('artist_id');
        $genresId = $request->input('genre_id');
        $albumId = $request->input('album_id');
        $album = Album::find($albumId);

        // Busca la canción por título dentro del álbum
        $cancion = $album->canciones()->where('title', $request->title)->first();

        if ($cancion) {
            return redirect()->route('songs.index')->with('alert', "Ya hay una canción con el nombre '{$request->title}' en el Álbum '{$album->title}'");
        }

        // Si la canción no existe, puedes crearla
        $nuevaCancion = new Song([
            'title' => $request->title,
            'album_id' => $albumId,
            'cover_img' => $album->cover_img,
        ]);

        $nuevaCancion->save();

        $nuevaCancion->generos()->sync($genresId);
        $nuevaCancion->artistas()->sync($artistsId );

        return redirect()->route('songs.index')->with('success', "La canción '{$request->title}' fue agregada al álbum '{$album->title}'.");
    }

    public function show(Song $song)
    {
        return view('dashboard.songs.show', [
            'song' => $song,
        ]);
    }

    public function edit($id)
    {
        $song = Song::findOrFail($id);

        $albums = Album::all();
        $genres = Genre::all();
        $artists = Artist::all();

        return view('dashboard.songs.edit', [
            'song' => $song,
            'albums' => $albums,
            'genres' => $genres,
            'artists' => $artists,
        ]);
    }

    public function update(Request $request, $id)
    {
        $song = Song::findOrFail($id);
        $song->title = $request->input('title');
        $song->generos()->sync($request->input('genre_id', []));
        $song->album_id = $request->input('album_id');
        $song->artistas()->sync($request->input('artist_id', []));
        $song->save();
        return redirect()->route('songs.index')->with('update', 'Canción Actualizada Correctamente!');
    }

    public function destroy($id)
    {
        $song = Song::findOrFail($id);
        $song->delete();
        return redirect()->back()->with('delete', 'Canción Eliminada Correctamente!');
    }
}
