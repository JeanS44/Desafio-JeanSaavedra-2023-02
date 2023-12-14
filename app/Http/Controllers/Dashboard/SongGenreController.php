<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Song;
use App\Http\Controllers\Controller;

class SongGenreController extends Controller
{
    public function index()
    {
        $songs = Song::with('generos')->get();

        return view('dashboard.songs_genres.index', [
            'songs' => $songs,
        ]);
    }
}
