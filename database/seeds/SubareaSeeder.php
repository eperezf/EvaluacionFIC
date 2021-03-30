<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SubareaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subareas = [
            'INFORMÁTICA',
            'BIOINGENIERIA',
            'TALLERES',
            'MATEMÁTICA',
            'FÍSICA',
            'INDUSTRIAL',
            'EYMA',
            'CIVIL',
            'MINERÍA',
            'MECÁNICA'
        ];
        
        foreach($subareas as $subarea)
        {
            DB::table('subarea')->insert([
                [
                    'nombre' => $subarea,
                    'idarea' => App\Area::where('nombre', 'Pregrado Santiago')->get()[0]->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
    }
}
