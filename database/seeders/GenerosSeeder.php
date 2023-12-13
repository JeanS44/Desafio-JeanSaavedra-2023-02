<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GenerosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('genres')->insert([
                'name' => $faker->unique()->word,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
