<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HealthUnit;

class HealthUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(public_path('catalogs/clues.csv'), 'r');
        $header = fgetcsv($file);

        while(($data = fgetcsv($file, 1000, ',')) !== false) {
            HealthUnit::create([
                'clues' => $data[0],
                'institution_name' => $data[1],
                'unit_name' => $data[2],
                'state' => $data[3],
                'road_name' => $data[4],
                'exterior_number' => $data[5],
                'settlement_type' => $data[6],
                'settlement' => $data[7],
                'postal_code' => $data[8],
            ]);
        }

        fclose($file);
    }
}
