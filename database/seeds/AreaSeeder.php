<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            'Industrial',
            'Informática',
            'Civil',
            'Mecánica',
            'Bioingeniería',
            'Enerigía y Medio Ambiente',
            'Minería',
            'Física',
            'Matemática',
            'Taller'
        ];

        foreach($areas as $area)
        {
            DB::table('area')->insert([
                [
                    'nombre' => $area,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ]);
        }
    }
}
