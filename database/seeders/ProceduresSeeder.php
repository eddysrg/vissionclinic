<?php

namespace Database\Seeders;

use App\Models\Procedure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProceduresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(public_path('catalogs/procedures.csv'), 'r');
        $header = fgetcsv($file);

        while(($data = fgetcsv($file, 1000, ',')) !== false) {
            Procedure::create([
                'catalog_key' => $data[0],
                'name' => $data[1],
            ]);
        }

        fclose($file);
    }
}
