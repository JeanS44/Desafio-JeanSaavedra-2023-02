<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrador',
            'created_at' => Carbon::now('America/Santiago'),
            'updated_at' => Carbon::now('America/Santiago'),
        ]);
        Role::create([
            'name' => 'Artista',
            'created_at' => Carbon::now('America/Santiago'),
            'updated_at' => Carbon::now('America/Santiago'),
        ]);
        Role::create([
            'name' => 'Oyente',
            'created_at' => Carbon::now('America/Santiago'),
            'updated_at' => Carbon::now('America/Santiago'),
        ]);
    }
}
