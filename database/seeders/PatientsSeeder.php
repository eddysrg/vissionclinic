<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Record;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('patients')->delete();
        $faker = Faker::create('es_MX');

        for ($i = 0; $i < 20; $i++) {

            DB::transaction(function() use ($faker) {
                $patientCreated = Patient::create([
                    'clinic_id' => 1,
                    'doctor_id' => 2,
                    'name' => $faker->firstName,
                    'father_last_name' => $faker->lastName,
                    'mother_last_name' => $faker->lastName,
                    'gender' => $faker->randomElement(['H', 'M']),
                    'birthdate' => $faker->date('Y-m-d'),
                    'birthplace' => 'DF',
                    'phone_number' => $faker->phoneNumber,
                    'curp' => $this->generateCURP($faker), // Función para generar CURP (ver abajo)
                ]);

                $recordCreated = Record::create([
                    'patient_id' => $patientCreated->id,
                    'type_record_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $sectionsCreated = DB::table('medical_record_sections')->insert([
                    [
                        'record_id' => $recordCreated->id,
                        'name' => 'summary',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'record_id' => $recordCreated->id,
                        'name' => 'clinic_history',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'record_id' => $recordCreated->id,
                        'name' => 'medical_consultation',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'record_id' => $recordCreated->id,
                        'name' => 'laboratory',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'record_id' => $recordCreated->id,
                        'name' => 'reference',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'record_id' => $recordCreated->id,
                        'name' => 'prescriptions',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'record_id' => $recordCreated->id,
                        'name' => 'pediatric_history',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'record_id' => $recordCreated->id,
                        'name' => 'digital_file',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                ]);

            });

            
        }
    }

    // Función para generar CURP (simplificada)
    private function generateCURP($faker)
    {
        $vowels = ['A', 'E', 'I', 'O', 'U'];
        $consonants = ['B', 'C', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z'];

        // Primeras cuatro letras (nombre y apellidos)
        $curp = strtoupper(substr($faker->lastName, 0, 1)); // Primera letra del primer apellido
        $curp .= $vowels[array_rand($vowels)]; // Primera vocal del primer apellido
        $curp .= strtoupper(substr($faker->firstName, 0, 1)); // Primera letra del segundo apellido
        $curp .= strtoupper(substr($faker->firstName, 0, 1)); // Primera letra del nombre

        // Fecha de nacimiento
        $birthDate = $faker->date('ymd');
        $curp .= $birthDate;

        // Sexo (H o M)
        $curp .= rand(0, 1) ? 'H' : 'M';

        // Entidad federativa (código aleatorio)
        $states = ['AS', 'BC', 'BS', 'CC', 'CL', 'CM', 'CS', 'CH', 'DF', 'DG', 'GT', 'GR', 'HG', 'JC', 'MC', 'MN', 'MS', 'NT', 'NL', 'OC', 'PL', 'QT', 'QR', 'SP', 'SL', 'SR', 'TC', 'TS', 'TL', 'VZ', 'YN', 'ZS'];
        $curp .= $states[array_rand($states)];

        // Consonantes internas
        $curp .= $consonants[array_rand($consonants)];
        $curp .= $consonants[array_rand($consonants)];
        $curp .= $consonants[array_rand($consonants)];

        // Homoclave y dígito verificador
        $curp .= rand(0, 9) . rand(0, 9);

        return $curp;
    }
}
