<?php

namespace App\Models;

use App\Models\Song;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function canciones()
    {
        return $this->belongsToMany(Song::class, 'songs_genres');
    }
}
