<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AlbumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $artistIds = DB::table('artists')->pluck('id')->toArray();

        foreach (range(1, 100) as $index) {
            DB::table('albums')->insert([
                'title' => $faker->unique()->sentence(3),
                'artist_id' => $faker->randomElement($artistIds),
                'year' => $faker->year,
                'cover_image' => $faker->imageUrl(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}