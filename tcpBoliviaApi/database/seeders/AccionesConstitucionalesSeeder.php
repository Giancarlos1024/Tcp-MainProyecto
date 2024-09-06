<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccionesConstitucionalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('acciones_constitucionales')->insert([
            ['nombre' => 'Accion de defensa'],
            ['nombre' => 'Accion de inconstitucionalidad'],
            ['nombre' => 'Conflictos'],
            ['nombre' => 'Consultas'],
            ['nombre' => 'Recurso'],
        ]);
    }
}
