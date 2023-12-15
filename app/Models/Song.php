<?php

namespace App\Models;

use App\Models\User;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Song extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'year',
        'cover_image',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function generos()
    {
        return $this->belongsToMany(Genre::class, 'songs_genres');
    }

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'users_songs');
    }

    public function artistas()
    {
        return $this->belongsToMany(Artist::class, 'artists_songs');
    }
}
