<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Alergenos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alergenos = [
            ['nombre' => 'Gluten'],
            ['nombre' => 'Mariscos'],
            ['nombre' => 'Huevos'],
            ['nombre' => 'Pescado'],
            ['nombre' => 'Cacahuetes'],
            ['nombre' => 'Soja'],
            ['nombre' => 'Leche'],
            ['nombre' => 'Frutos secos'],
            ['nombre' => 'Apio'],
            ['nombre' => 'Mostaza'],
            ['nombre' => 'Sésamo'],
            ['nombre' => 'Sulfitos'],
            ['nombre' => 'Altramuces'],
            ['nombre' => 'Moluscos'],
        ];

        DB::table('alergenos')->insert($alergenos);
    }
}
