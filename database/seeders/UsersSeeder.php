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
                'degree' => 'Dr.',
                'name' => 'Eduardo',
                'father_lastname' => 'Ramírez',
                'mother_lastname' => 'Galindo',
                'gender' => 'male',
                'birthdate' => '1997-10-01',
                'phone_number' => '5689065329',
                'email' => 'eddysrg@email.com',
                'curp' => 'RAGE971001HDFLND00',
                'rfc' => 'RAGE9710016H8',
                'username' => 'eddysrg',
                'password' => Hash::make('eddysrg1890*'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        User::create(
            [
                'clinic_id' => 1,
                'role_id' => 1,
                'degree' => 'Dra.',
                'name' => 'Jessica',
                'father_lastname' => 'Camargo',
                'mother_lastname' => 'Rangel',
                'gender' => 'female',
                'birthdate' => '1997-10-01',
                'phone_number' => '5689065329',
                'email' => 'jessica.camargo@gdc-cala.com.mx',
                'curp' => 'CARE971001HDFLND00',
                'rfc' => 'CARE9710016H8',
                'username' => 'jessica_camargo',
                'password' => Hash::make('nx$c@AEtPe5r'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        User::create(
            [
                'clinic_id' => 1,
                'role_id' => 1,
                'degree' => 'Dr.',
                'name' => 'Luis Antonio',
                'father_lastname' => 'Flores',
                'mother_lastname' => 'García',
                'gender' => 'male',
                'birthdate' => '1997-10-01',
                'phone_number' => '5689065329',
                'email' => 'drluisflores@hotmail.com',
                'curp' => 'FOLG971001HDFLND00',
                'rfc' => 'FOLG9710016H8',
                'username' => 'luis_flores',
                'password' => Hash::make('dN0F9m}Y^)96'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
