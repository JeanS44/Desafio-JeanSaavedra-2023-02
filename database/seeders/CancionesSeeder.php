<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CancionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $albumIds = DB::table('albums')->pluck('id')->toArray();

        foreach (range(1, 200) as $index) {
            DB::table('songs')->insert([
                'album_id' => $faker->randomElement($albumIds),
                'title' => $faker->unique()->sentence(3),
                'cover_img' => $faker->imageUrl(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
