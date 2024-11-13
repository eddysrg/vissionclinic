<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'Administrador',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Role::create([
            'name' => 'Doctor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Role::create([
            'name' => 'Asistente',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
