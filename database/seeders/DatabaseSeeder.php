<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(RouteNameSeeder::class);

        // \App\Models\Patient::factory(20)->create();

        $this->call([
            RouteNameSeeder::class,
            ClinicsSeeder::class,
            RolesSeeder::class,
            UsersSeeder::class,
            CountrySeeder::class,
            LocalitiesSeeder::class,
            StateCodesSeeder::class,
            TypeRecordSeeder::class,
            DiagnosesSeeder::class,
            ProceduresSeeder::class
        ]);
    }
}
