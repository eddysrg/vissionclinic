<?php

namespace Database\Seeders;

use App\Models\PathologicalHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PathologicalHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PathologicalHistory::create([
            'medical_record_id' => 2,
        ]);
    }
}
