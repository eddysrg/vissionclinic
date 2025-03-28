<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\MedicalUnit;
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

        DB::transaction(function () {

            $medicalUnitCreated = MedicalUnit::create([
                'name' => 'Consultorio Alterno Privado',
                'address' => 'Periférico Sur 2903, Piso 8 Col. Jardines en la Montaña C.P. 14210, México. CDMX',
                'phone' => '5509494350',
                'unit_type_id' => 4
            ]);

            $userCreated = User::create([
                'degree' => 'Dr',
                'name' => 'LUIS',
                'last_name' => 'HERNANDEZ FELICIANO',
                'gender' => 'male',
                'birthdate' => '1977-02-09',
                'phone_number' => '6653289017',
                'email' => 'luis.hernandez@outlook.com',
                'rfc' => 'HEFL9701105A7',
                'curp' => 'HEFL970110HDFMLD02',
                'username' => 'luis_hernandez',
                'password' => Hash::make('mokachida1891*'),
                'medical_unit_id' => $medicalUnitCreated->id,
                'role_id' => 2,
            ]);

            if($userCreated->role_id === 2) {
                Doctor::create([
                    'license_number' => '12083201',
                    'specialty' => 'Medicina Interna',
                    'user_id' => $userCreated->id
                ]);
            }

        });
        // DB::transaction(function () {
        //     $laloUser = User::create(
        //         [
        //             'clinic_id' => 1,
        //             'role_id' => 1,
        //             'degree' => 'Dr.',
        //             'name' => 'Eduardo',
        //             'father_lastname' => 'Ramírez',
        //             'mother_lastname' => 'Galindo',
        //             'gender' => 'male',
        //             'birthdate' => '1997-10-01',
        //             'phone_number' => '5689065329',
        //             'email' => 'eddysrg@email.com',
        //             'curp' => 'RAGE971001HDFLND00',
        //             'rfc' => 'RAGE9710016H8',
        //             'username' => 'eddysrg',
        //             'password' => Hash::make('eddysrg1890*'),
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]
        //     );
    
        //     $jessUser = User::create(
        //         [
        //             'clinic_id' => 1,
        //             'role_id' => 1,
        //             'degree' => 'Dra.',
        //             'name' => 'Jessica',
        //             'father_lastname' => 'Camargo',
        //             'mother_lastname' => 'Rangel',
        //             'gender' => 'female',
        //             'birthdate' => '1997-10-01',
        //             'phone_number' => '5689065329',
        //             'email' => 'jessica.camargo@gdc-cala.com.mx',
        //             'curp' => 'CARE971001HDFLND00',
        //             'rfc' => 'CARE9710016H8',
        //             'username' => 'jessica_camargo',
        //             'password' => Hash::make('nx$c@AEtPe5r'),
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]
        //     );
    
        //     $luisUser = User::create(
        //         [
        //             'clinic_id' => 2,
        //             'role_id' => 1,
        //             'degree' => 'Dr.',
        //             'name' => 'Luis Antonio',
        //             'father_lastname' => 'Flores',
        //             'mother_lastname' => 'García',
        //             'gender' => 'male',
        //             'birthdate' => '1997-10-01',
        //             'phone_number' => '5689065329',
        //             'email' => 'drluisflores@hotmail.com',
        //             'curp' => 'FOLG971001HDFLND00',
        //             'rfc' => 'FOLG9710016H8',
        //             'username' => 'luis_flores',
        //             'password' => Hash::make('dN0F9m}Y^)96'),
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]
        //     );

        //     DB::table('doctors')->insert([
        //         ['user_id' => $laloUser->id, 'created_at' => now(), 'updated_at' => now()],
        //         ['user_id' => $jessUser->id, 'created_at' => now(), 'updated_at' => now()],
        //         ['user_id' => $luisUser->id, 'created_at' => now(), 'updated_at' => now()],
        //     ]);
        // });
        
    }
}
