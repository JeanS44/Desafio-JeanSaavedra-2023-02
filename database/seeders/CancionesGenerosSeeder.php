<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CancionesGenerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $songs = DB::table('songs')->pluck('id')->toArray();
        $genres = DB::table('genres')->pluck('id')->toArray();

        foreach (range(1, 300) as $index) {
            DB::table('songs_genres')->insert([
                'song_id' => rand(1, count($songs)),
                'genre_id' => rand(1, count($genres)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
