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
            'PREGRADO',
            'POSTGRADO'
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
