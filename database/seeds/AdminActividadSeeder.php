<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('actividad')->insert([
            [
                'idtipoactividad' => App\Tipoactividad::where('nombre', 'Administración')->get('id')[0]->id,
                'inicio' => Carbon::now(),
                'termino' => Carbon::parse('2100-01-01'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
