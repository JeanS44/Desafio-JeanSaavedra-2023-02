<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Http\Controllers\Controller;

class UserSongController extends Controller
{
    public function index()
    {
        $users = User::with('canciones')->get();
        
        return view('dashboard.users_songs.index', [
            'users' => $users,
        ]);
    }
}
