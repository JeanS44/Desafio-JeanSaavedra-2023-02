<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('artista')->get();

        return view('dashboard.albums.index', [
            'albums' => $albums,
        ]);
    }
}
