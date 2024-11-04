<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Patient::create([
            'clinic_id' => 'required|numeric',
            'doctor_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'father_last_name' => 'required|string|max:255',
            'mother_last_name' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'birthdate' => 'required|date',
            'phone_number' => 'required|digits:10',
            'curp' => 'required|min:18|unique:App\Models\Patient,curp',
        ]);
    }
}
