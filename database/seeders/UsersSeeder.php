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
                'clinic_id' => 1,
                'role_id' => 1,
                'name' => 'Eduardo Ramírez Galindo',
                'username' => 'eddysrg',
                'email' => 'eddysrg@outlook.com',
                'password' => Hash::make('eddysrg1890*'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // User::create([
        //     'clinic_id' => 2,
        //     'role_id' => 1,
        //     'name' => 'Juan García Perez',
        //     'username' => 'juan_garcia',
        //     'email' => 'jgarcia@email.com',
        //     'password' => Hash::make('jgarcia1097*'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
