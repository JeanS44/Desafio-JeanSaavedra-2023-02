<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::latest()->get();

        return view('dashboard.genres.index', [
            'genres' => $genres,
        ]);
    }

    public function create()
    {
        return view('dashboard.genres.add');
    }


    public function store(Request $request)
    {
        if (Genre::where('name', $request->name)->count() > 0) {
            return redirect()->back()->with('error', 'Este Género ya está registrado!');
        } else {
            $request->validate([
                'name' => ['required', 'string', 'min:1', 'max:255'],
            ]);

            $genre = Genre::create([
                'name' => $request->name
            ]);
            event(new Registered($genre));
            return redirect()->route('genres.index')->with('success', 'Género Registrado Correctamente!');
        }
    }

    public function show(Genre $genre)
    {
        return view('dashboard.genres.show', [
            'genre' => $genre,
        ]);
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);

        return view('dashboard.genres.edit', [
            'genre' => $genre,
        ]);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        /* $request->validate([
            'name' => ['string', 'min:1', 'max:255'],
            'surname' => ['string', 'min:1', 'max:255'],
            'username' => ['string', 'min:3', 'max:30', 'unique:users,username'],
            'email' => ['string', 'email', 'max:255', 'unique:users,email'],
        ]); */
        $genre->name = $request->input('name');
        $genre->save();
        return redirect()->route('genres.index')->with('update', 'Género Actualizado Correctamente!');
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        $genre->delete();
        return redirect()->back()->with('delete', 'Género Eliminado Correctamente!');
    }
}
