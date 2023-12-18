<?php

namespace App\Http\Controllers\Dashboard;

use getID3;
use App\Models\Song;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-boton-musica|ver-cancion|ver-tabla-cancion|crear-cancion|editar-cancion|mostrar-cancion|borrar-cancion', ['only' => ['index']]);
        $this->middleware('permission:crear-cancion', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-cancion', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mostrar-cancion', ['only' => ['show']]);
        $this->middleware('permission:borrar-cancion', ['only' => ['destroy']]);
    }

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
        $nuevaCancion = new Song();
        $getID3 = new getID3();


        $albumId = $request->input('album_id');
        $album = Album::find($albumId);
        $cancion = $album->canciones()->where('title', $request->title)->first();

        if ($cancion) {
            return redirect()->route('songs.index')->with('alert', "Ya hay una canción con el nombre '{$request->title}' en el Álbum '{$album->title}'");
        }

        $artistsId = $request->input('artist_id');
        $genresId = $request->input('genre_id');
        $file = $request->file('mp3');
        $fileInfo = $getID3->analyze($file->getRealPath());
        $durationInSeconds = $fileInfo['playtime_seconds'];
        $destinationPath = 'songs/';
        $filename = $file->getClientOriginalName();
        $request->file('mp3')->move($destinationPath, $filename);

        /* dd($albumId, $cancion->getClientOriginalName(), $artistsId, $genresId, $request->title, $album->cover_img); */

        $nuevaCancion->album_id = $albumId;
        $nuevaCancion->title = $request->title;
        $nuevaCancion->cover_img = $album->cover_img;
        $nuevaCancion->mp3 = 'songs/' . $file->getClientOriginalName();
        $nuevaCancion->duration = intval($durationInSeconds);
        $nuevaCancion->extension = $fileInfo['mime_type'];


        $nuevaCancion->save();

        $nuevaCancion->generos()->sync($genresId);
        $nuevaCancion->artistas()->sync($artistsId);

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

        $mp3FilePath = public_path('songs' . $song->mp3);

        return view('dashboard.songs.edit', [
            'song' => $song,
            'albums' => $albums,
            'genres' => $genres,
            'artists' => $artists,
            'mp3FilePath' => $mp3FilePath,
        ]);
    }

    public function update(Request $request, $id)
    {
        $getID3 = new getID3();
        $datosSong = request()->except(['_token', '_method']);

        $file = $request->file('mp3');
        $fileInfo = $getID3->analyze($file->getRealPath());
        $durationInSeconds = $fileInfo['playtime_seconds'];
        $destinationPath = 'songs/';
        $filename = $file->getClientOriginalName();
        $request->file('mp3')->move($destinationPath, $filename);
        $datosSong['mp3'] = 'songs/' . $file->getClientOriginalName();


        $song = Song::findOrFail($id);
        $song->title = $request->input('title');
        $song->generos()->sync($request->input('genre_id', []));
        $song->album_id = $request->input('album_id');
        $song->artistas()->sync($request->input('artist_id', []));
        $song->mp3 = $datosSong['mp3'];
        $song->duration = intval($durationInSeconds);
        $song->extension = $fileInfo['mime_type'];

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
