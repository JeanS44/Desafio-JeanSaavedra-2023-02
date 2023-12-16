<?php

namespace App\Models;

use App\Models\Song;
use App\Models\Artist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'artist_id',
        'title',
        'year',
        'cover_img',
    ];

    public function artista()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function canciones()
    {
        return $this->hasMany(Song::class);
    }
}
