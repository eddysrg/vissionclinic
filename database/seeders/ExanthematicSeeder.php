<?php

namespace Database\Seeders;

use App\Models\Exanthematic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExanthematicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('exanthematics')->insert([
            [
                'disease' => 'Varicela',
                'applies' => 0,
                'observations' => '',
                'pathological_history_id' => 1,
            ],
            [
                'disease' => 'Rubeola',
                'applies' => 0,
                'observations' => '',
                'pathological_history_id' => 1,
            ],
            [
                'disease' => 'Sarampión',
                'applies' => 0,
                'observations' => '',
                'pathological_history_id' => 1,
            ],
            [
                'disease' => 'Escarlatina',
                'applies' => 0,
                'observations' => '',
                'pathological_history_id' => 1,
            ],
            [
                'disease' => 'Exantema súbito',
                'applies' => 0,
                'observations' => '',
                'pathological_history_id' => 1,
            ],
        ]);
    }
}
