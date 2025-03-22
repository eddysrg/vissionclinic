<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Doctor;
use App\Models\User;
use App\Models\MedicalUnit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(RouteNameSeeder::class);

        // \App\Models\Patient::factory(20)->create();

        // $this->call([
        //     RouteNameSeeder::class,
        //     ClinicsSeeder::class,
        //     RolesSeeder::class,
        //     UsersSeeder::class,
        //     CountrySeeder::class,
        //     LocalitiesSeeder::class,
        //     StateCodesSeeder::class,
        //     TypeRecordSeeder::class,
        //     DiagnosesSeeder::class,
        //     ProceduresSeeder::class
        // ]);

        DB::transaction(function () {

            DB::table('roles')->insert([
                ['role' => 'Administrator'],
                ['role' => 'Doctor'],
                ['role' => 'Assistant'],
            ]);
    
            DB::table('unit_types')->insert([
                ['type' => 'Hospital Privado'],
                ['type' => 'Hospital Público'],
                ['type' => 'Clínica Privada'],
                ['type' => 'Consultorio Privado']
            ]);
    
            $medicalUnitCreated = MedicalUnit::create([
                'name' => 'Consultorio VissionClinic',
                'address' => 'Periférico Sur 4225, Piso 3 Col. Jardines en la Montaña C.P. 14210, México. CDMX',
                'phone' => '5554496250',
                'unit_type_id' => 4
            ]);

            $userCreated = User::create([
                'degree' => 'Dr',
                'name' => 'EDUARDO',
                'last_name' => 'RAMIREZ GALINDO',
                'gender' => 'male',
                'birthdate' => '1997-01-10',
                'phone_number' => '5555555555',
                'email' => 'eddysrg@outlook.com',
                'rfc' => 'RAGE9701105A7',
                'curp' => 'RAGE970110HDFMLD02',
                'username' => 'eddysrg',
                'password' => Hash::make('mokachida1890*'),
                'medical_unit_id' => $medicalUnitCreated->id,
                'role_id' => 2,
            ]);

            if($userCreated->role_id === 2) {
                Doctor::create([
                    'license_number' => '93920292',
                    'specialty' => 'Medicina Interna',
                    'user_id' => $userCreated->id
                ]);
            }

        });

        
    }
}
