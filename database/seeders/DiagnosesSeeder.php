<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Diagnosis;
use Illuminate\Support\Facades\DB;

class DiagnosesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(public_path('catalogs/diagnoses.csv'), 'r');
        $header = fgetcsv($file);

        while(($data = fgetcsv($file, 1000, ',')) !== false) {
            DB::table('diagnoses')->insert([
                'catalog_key' => $data[0],
                'name' => $data[1],
                'require_epi_study' => $data[2],
            ]);
        }

        fclose($file);
    }
}
