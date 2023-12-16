<?php

namespace App\Models;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function canciones()
    {
        return $this->belongsToMany(Song::class, 'artists_songs');
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
