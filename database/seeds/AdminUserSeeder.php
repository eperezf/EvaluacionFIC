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
            'José Ignacio'
        ];
        $apellidos = [
            'Selman',
            'Pérez',
            'Vásquez',
            'Miquel'
        ];
        $emails = [
            'niselman@alumnos.uai.cl',
            'eduperez@alumnos.uai.cl',
            'dvasquez@alumnos.uai.cl',
            'jomiquel@alumnos.uai.cl'
        ];
        $users = array_map(null, $nombres, $apellidos, $emails);
        foreach($users as $user)
        {
            DB::table('user')->insert([
                [
                    'nombres' => $user[0],
                    'apellidoPaterno' => $user[1],
                    'apellidoMaterno' => NULL,
                    'email' => $user[2],
                    'rut' => NULL,
                    'password' => 'INTUAI',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
    }
}
