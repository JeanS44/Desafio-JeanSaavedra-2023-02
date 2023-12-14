<?php

namespace App\Models;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
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

    public function artista()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }
}
