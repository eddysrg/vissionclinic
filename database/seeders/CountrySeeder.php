<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = storage_path('app/public/countries.json');

        if(File::exists($jsonPath)) {
            $countries = json_decode(File::get($jsonPath), true);

            if(is_null($countries)) {
                $this->command->error('El archivo "countries.json" no es valido');
                return;
            }

            foreach($countries['countries'] as $country) {
                if(isset($country['code']) && isset($country['name'])) {
                    DB::table('countries')->insert([
                        'code' => $country['code'],
                        'name' => $country['name'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                } else {
                    $this->command->warn('Registro omitido: Falta la clave "code" o "name"');
                }
            }

            $this->command->info('Países insertados correctamente');
        } else {
            $this->command->error('El archivo "countries.json" no existe en la ruta especificada');
        }
        
    }
}
