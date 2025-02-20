<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(public_path('catalogs/medicines.csv'), 'r');
        $header = fgetcsv($file);

        while(($data = fgetcsv($file, 1000, ',')) !== false) {
            Medicine::create([
                'name' => $data[0],
                'presentation' => $data[1],
                'concentration' => $data[2],
                'fraction' => $data[3],
                'denomination' => $data[4],
                'health_registration' => $data[5],
                'holder' => $data[6],
                'indication' => $data[7],
            ]);

            $this->command->info('Fármaco agregado a la lista');
        }

        fclose($file);

        $this->command->info('Lista de fármacos agregada');
    }
}
