<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('artista')->latest()->get();

        return view('dashboard.albums.index', [
            'albums' => $albums,
        ]);
    }

    public function create()
    {
        $artists = Artist::all();
        return view('dashboard.albums.add', [
            'artists' => $artists,
        ]);
    }

    public function store(Request $request)
    {
        $newAlbum = new Album();
        $artistId = $request->input('artist_id');

        $request->validate([
            'artist_id' => 'required',
            'title' => 'required|string',
            'cover_img' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'year' => 'required|numeric',
        ]);

        if ($request->hasFile('cover_img')) {
            $file = $request->file('cover_img');
            $destinationPath = 'images/albums_covers/';
            $filename = $file->getClientOriginalName();
            $uploadSuccess = $request->file('cover_img')->move($destinationPath, $filename);
            $newAlbum->cover_img = $destinationPath . $filename;
        }

        $newAlbum->artist_id = $artistId;
        $newAlbum->title = $request->title;
        $newAlbum->year = $request->year;

        $newAlbum->save();

        // Redireccionar o realizar alguna acción después de guardar
        return redirect()->route('albums.index')->with('success', 'Álbum creado correctamente.');
    }

    public function edit($id)
    {
        $album = Album::findOrFail($id);
        $artists = Artist::all();

        return view('dashboard.albums.edit', [
            'album' => $album,
            'artists' => $artists,
        ]);
    }

    public function update(Request $request, $id)
    {
        $datosAlbum = request()->except(['_token', '_method']);

        if ($request->hasFile('cover_img')) {
            $album = Album::findOrFail($id);
            $file = $request->file('cover_img');
            $destinationPath = 'images/albums_covers/';
            $filename = $file->getClientOriginalName();
            // Eliminar la imagen antigua antes de actualizarla
            Storage::delete('public/images/albums_covers/' . $album->cover_img);

            // Almacenar la nueva imagen y actualizar el campo cover_img
            $datosAlbum['cover_img'] = $request->file('cover_img')->move($destinationPath, $filename);
            $album->cover_img = $destinationPath . $filename;
        }


        // Utilizar el método update directamente en el modelo
        Album::where('id', $id)->update($datosAlbum);
        $album = Album::findOrFail($id);
        $album->save();
        return redirect()->route('albums.index')->with('update', 'Álbum actualizado correctamente!');
    }

    public function show(Album $album)
    {
        return view('dashboard.albums.show', [
            'album' => $album,
        ]);
    }

    public function destroy($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();
        return redirect()->back()->with('delete', 'Album Eliminado Correctamente!');
    }
}
