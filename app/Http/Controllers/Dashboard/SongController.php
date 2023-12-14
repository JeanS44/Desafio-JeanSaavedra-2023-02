<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Song;
use App\Http\Controllers\Controller;

class SongController extends Controller
{
    public function index()
    {
        $songs = Song::with('album')->get();

        return view('dashboard.songs.index', [
            'songs' => $songs,
        ]);
    }
}
