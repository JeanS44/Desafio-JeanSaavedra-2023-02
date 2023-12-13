<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuariosCancionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->pluck('id')->toArray();
        $songs = DB::table('songs')->pluck('id')->toArray();

        foreach (range(1, 150) as $index) {
            DB::table('users_songs')->insert([
                'user_id' => rand(1, count($users)),
                'song_id' => rand(1, count($songs)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
