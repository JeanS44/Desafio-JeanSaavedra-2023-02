<?php

namespace App\Models;

use App\Models\Song;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artist extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public function canciones()
    {
        return $this->belongsToMany(Song::class, 'artists_songs');
    }
}
