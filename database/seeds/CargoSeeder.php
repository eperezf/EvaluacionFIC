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
                'nombre' => 'Director de investigación',
                'idtipoactividad' => App\Tipoactividad::where('nombre', 'Investigacion')->get('id')[0]->id,
                'peso' => '5', //No se qué peso ponerle
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nombre' => 'Director ejecutivo de investigación',
                'idtipoactividad' => App\Tipoactividad::where('nombre', 'Investigación')->get('id')[0]->id,
                'peso' => '5', //No se qué peso ponerle
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nombre' => 'Director de docencia',
                'idtipoactividad' => App\Tipoactividad::where('nombre', 'Asignatura')->get('id')[0]->id,
                'peso' => '3', //No se qué peso ponerle
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nombre' => 'Subdirector de docencia',
                'idtipoactividad' => App\Tipoactividad::where('nombre', 'Asignatura')->get('id')[0]->id,
                'peso' => '2', //No se qué peso ponerle
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nombre' => 'Director de área',
                'idtipoactividad' => App\Tipoactividad::where('nombre', 'Área')->get('id')[0]->id,
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
