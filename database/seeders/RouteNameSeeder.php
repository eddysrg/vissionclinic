<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RouteNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('route_names')->truncate();

        DB::table('route_names')->insert([
            [
                'route_name' => 'nivel-uno',
                'title' => 'HealthCare System',
                'subtitle' => 'Nivel 1'
            ],
            [
                'route_name' => 'nivel-dos',
                'title' => 'HealthCare System',
                'subtitle' => 'Nivel 2'
            ],
            [
                'route_name' => 'mvs',
                'title' => 'Medical View System',
                'subtitle' => 'mvs'
            ],
            [
                'route_name' => 'lyrium',
                'title' => 'Lyrium',
                'subtitle' => ''
            ],
            [
                'route_name' => 'productos',
                'title' => 'Nuestros Productos',
                'subtitle' => ''
            ],
            [
                'route_name' => 'laboratorio',
                'title' => 'Laboratorio',
                'subtitle' => ''
            ],
            [
                'route_name' => 'ingresos',
                'title' => 'Ingresos',
                'subtitle' => ''
            ],
            [
                'route_name' => 'medical-view-system',
                'title' => 'Medical View System',
                'subtitle' => ''
            ],
            [
                'route_name' => 'odontologia',
                'title' => 'Odontología',
                'subtitle' => ''
            ],
            [
                'route_name' => 'nutricion',
                'title' => 'Nutrición',
                'subtitle' => ''
            ],
            [
                'route_name' => 'ginecologia',
                'title' => 'Ginecología',
                'subtitle' => ''
            ],
        ]);
    }
}
