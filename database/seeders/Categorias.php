<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Categorias extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nombreCategoria' => 'Entrantes'],
            ['nombreCategoria' => 'Platos Principales'],
            ['nombreCategoria' => 'Postres'],
        ];

        DB::table('categorias')->insert($categorias);
    }
}
