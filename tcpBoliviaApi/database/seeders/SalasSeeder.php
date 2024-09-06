<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Resolucion;
use League\Csv\Reader;

class SalasSeeder extends Seeder
{
    public function run()
    {

DB::table('salas')->insert([
            ['nombre' => 'CA'],
            ['nombre' => 'SP1'],
            ['nombre' => 'SP2'],
            ['nombre' => 'SP3'],
            ['nombre' => 'SP4'],
            ['nombre' => 'SPL'],
        ]);
    }

}
