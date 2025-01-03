<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\PostalCode;
use App\Models\Municipality;
use App\Models\Settlement;
use App\Models\SettlementType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocalitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

public function run(): void
{
    // Ruta de la carpeta que contiene los archivos CSV
    $folderPath = public_path('states');

    // Obtiene todos los archivos CSV en la carpeta
    $files = glob($folderPath . '/*.csv');

    foreach ($files as $filePath) {
        $file = fopen($filePath, 'r');
        $header = fgetcsv($file); // Leer encabezado

        while (($data = fgetcsv($file, 1000, ',')) !== false) {
            // Crear o buscar estado
            $state = State::firstOrCreate([
                'countries_id' => 123,
                'name' => $data[4],
            ]);

            // Crear o buscar municipio
            $municipality = Municipality::firstOrCreate([
                'name' => $data[3],
                'states_id' => $state->id,
            ]);

            // Crear o buscar código postal
            $postalCode = PostalCode::firstOrCreate([
                'postal_code' => $data[0],
            ]);

            // Crear o buscar tipo de asentamiento
            $settlementType = SettlementType::firstOrCreate([
                'type' => $data[2],
            ]);

            // Crear asentamiento
            Settlement::create([
                'name' => $data[1],
                'postal_codes_id' => $postalCode->id,
                'settlement_types_id' => $settlementType->id,
                'municipalities_id' => $municipality->id,
                'states_id' => $state->id,
            ]);
        }

        fclose($file);
        $this->command->info('Procesado archivo: ' . basename($filePath));
    }

    $this->command->info('¡Todos los archivos CSV han sido procesados correctamente!');
}

}
