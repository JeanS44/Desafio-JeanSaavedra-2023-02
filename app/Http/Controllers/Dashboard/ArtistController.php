<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::latest()->get();

        return view('dashboard.artists.index', [
            'artists' => $artists,
        ]);
    }

    public function create()
    {
        return view('dashboard.artists.add');
    }


    public function store(Request $request)
    {
        if (Artist::where('name', $request->name)->count() > 0) {
            return redirect()->back()->with('error', 'Este artista ya está registrado!');
        } else {
            $request->validate([
                'name' => ['required', 'string', 'min:1', 'max:255'],
            ]);

            $artist = Artist::create([
                'name' => $request->name
            ]);

            event(new Registered($artist));
            return redirect()->route('artists.index')->with('success', 'Artista Registrado Correctamente!');
        }
    }

    public function show(Artist $artist)
    {
        return view('dashboard.artists.show', [
            'artist' => $artist,
        ]);
    }

    public function edit($id)
    {
        $artist = Artist::findOrFail($id);

        return view('dashboard.artists.edit', [
            'artist' => $artist,
        ]);
    }

    public function update(Request $request, $id)
    {
        $artist = Artist::findOrFail($id);
        /* $request->validate([
            'name' => ['string', 'min:1', 'max:255'],
            'surname' => ['string', 'min:1', 'max:255'],
            'username' => ['string', 'min:3', 'max:30', 'unique:users,username'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email'],
        ]); */
        $artist->name = $request->input('name');
        $artist->save();
        return redirect()->route('artists.index')->with('update', 'Artista Actualizado Correctamente!');
    }

    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);
        $artist->delete();
        return redirect()->back()->with('delete', 'Artista Eliminado Correctamente!');
    }
}
