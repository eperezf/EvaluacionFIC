<?php

use Illuminate\Database\Seeder;
use App\TipoActividad;
use Carbon\Carbon;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cargo')->insert([
            [
                'nombre' => 'Administrador',
                'idtipoactividad' => App\Tipoactividad::where('nombre', 'Administración')->get('id')[0]->id,
                'peso' => '9999',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nombre' => 'Investigador',
                'idtipoactividad' => App\Tipoactividad::where('nombre', 'Investigacion')->get('id')[0]->id,
                'peso' => '2', //No se qué peso ponerle
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nombre' => 'Profesor',
                'idtipoactividad' => App\Tipoactividad::where('nombre', 'Curso')->get('id')[0]->id,
                'peso' => '1', //No se qué peso ponerle
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
