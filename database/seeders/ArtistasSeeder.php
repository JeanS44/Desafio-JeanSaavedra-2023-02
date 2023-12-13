<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('artists')->insert([
                'name' => $faker->unique()->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
