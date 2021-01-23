<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminUserActividadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emails = [
            'niselman@alumnos.uai.cl',
            'eduperez@alumnos.uai.cl',
            'dvasquez@alumnos.uai.cl',
            'jomiquel@alumnos.uai.cl',
            'danigomez@alumnos.uai.cl',
            'rafael.cereceda@uai.cl'
        ];
        foreach($emails as $email)
        {
            DB::table('user_actividad')->insert([
                [
                    'iduser' => App\User::where('email', $email)->get()[0]->id,
                    'idactividad' => App\Actividad::first()->id,
                    'idcargo' => App\Cargo::first()->id,
                    'comentario' => NULL,
                    'bonificacion' => NULL,
                    'calificacion' => NULL,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
    }
}
