<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Eduardo Ramírez Galindo',
                'username' => 'eddysrg',
                'email' => 'correo@correo.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        User::create([
            'name' => 'Juan Inventado Perez',
            'username' => 'juan_inventado',
            'email' => 'correo2@correo.com',
            'password' => Hash::make('mypassword'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
