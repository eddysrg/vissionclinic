<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = fopen(public_path('catalogs/state_codes.csv'), 'r');
        $header = fgetcsv($file);
        while(($data = fgetcsv($file)) !== false) {
            State::where('name', $data[1])->update(['state_code' => $data[2]]);
        }
        fclose($file);
    }
}
