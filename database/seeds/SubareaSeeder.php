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
        $subareas_pregrado = [
            'INFORMÁTICA',
            'BIOINGENIERIA',
            'TALLERES',
            'MATEMÁTICA',
            'FÍSICA',
            'INDUSTRIAL',
            'EYMA',
            'CIVIL',
            'MINERÍA',
            'MECÁNICA',
            'MECANISMO DE TITULACIÓN'
        ];
        
        $subareas_quinto = [
            'MCI',
            'MIF',
            'MIIIO',
            'MSDS',
            'OTRAS'
        ];

        $subareas_postgrado = [
            'EDUCACIÓN EJECUTIVA',
            'DOCTORADO'
        ];
        
        foreach($subareas_pregrado as $subarea)
        {
            DB::table('subarea')->insert([
                [
                    'nombre' => $subarea,
                    'idarea' => App\Area::where('nombre', 'PREGRADO')->get()[0]->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
        foreach($subareas_quinto as $subarea)
        {
            DB::table('subarea')->insert([
                [
                    'nombre' => $subarea,
                    'idarea' => App\Area::where('nombre', 'QUINTO AÑO')->get()[0]->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
        foreach($subareas_postgrado as $subarea)
        {
            DB::table('subarea')->insert([
                [
                    'nombre' => $subarea,
                    'idarea' => App\Area::where('nombre', 'POSTGRADO')->get()[0]->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
    }
}
