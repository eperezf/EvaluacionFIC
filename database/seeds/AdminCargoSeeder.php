<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminCargoSeeder extends Seeder
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
            ]
        ]);
    }
}
