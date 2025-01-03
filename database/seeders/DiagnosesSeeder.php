<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Diagnosis;

class DiagnosesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(storage_path('app/catalogs/diagnoses.csv'), 'r');
        $header = fgetcsv($file);

        while(($data = fgetcsv($file, 1000, ',')) !== false) {
            Diagnosis::create([
                'catalog_key' => $data[0],
                'name' => $data[1],
                'require_epi_study' => $data[2],
            ]);
        }

        fclose($file);
    }
}
