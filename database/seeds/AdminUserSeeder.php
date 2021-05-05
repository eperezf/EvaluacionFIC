<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nombres = [
            'Nicolás',
            'Eduardo',
            'Dayhan',
            'José Ignacio',
            'Daniela',
            'Rafael'
        ];
        $apellidos = [
            'Selman',
            'Pérez',
            'Vásquez',
            'Miquel',
            'Gómez',
            'Cereceda'
        ];
        $emails = [
            'niselman@alumnos.uai.cl',
            'eduperez@alumnos.uai.cl',
            'dvasquez@alumnos.uai.cl',
            'jomiquel@alumnos.uai.cl',
            'danigomez@alumnos.uai.cl',
            'rafael.cereceda@uai.cl'
        ];
        $ruts = [
            "20074926-K",
            NULL,
            "20180439-6",
            "20081454-1",
            NULL,
            "10587852-4"
        ];
        $users = array_map(null, $nombres, $apellidos, $emails, $ruts);
        foreach($users as $user)
        {
            DB::table('user')->insert([
                [
                    'nombres' => $user[0],
                    'apellidoPaterno' => $user[1],
                    'apellidoMaterno' => NULL,
                    'email' => $user[2],
                    'rut' => $user[3],
                    'password' => 'INTUAI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
    }
}
