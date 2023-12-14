<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::all();

        return view('dashboard.artists.index', [
            'artists' => $artists,
        ]);
    }
}
