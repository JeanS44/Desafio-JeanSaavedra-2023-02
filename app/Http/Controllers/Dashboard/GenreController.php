<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Genre;
use App\Http\Controllers\Controller;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        return view('dashboard.genres.index', [
            'genres' => $genres,
        ]);
    }
}
