<?php

use Illuminate\Database\Seeder;

class TipoActividadSeeder extends Seeder
{
    /**
     * Crea los tipos de actividad necesarios en la base de datos
     * @author Eduardo Pérez
     * @return void
     */
    public function run()
    {
      DB::table('tipoactividad')->insert([
        ['id' => '3', 'nombre' => 'Administración'],
				['id'=>'4', 'nombre'=>'Área'],
				['id'=>'5', 'nombre'=>'Asignatura'],
        ['id'=>'6', 'nombre'=>'Curso'],
        ['id'=>'7', 'nombre'=>'Libro'],
        ['id'=>'8', 'nombre'=>'Licencia'],
        ['id'=>'9', 'nombre'=>'Perfeccionamiento docente'],
        ['id'=>'10', 'nombre'=>'Proyecto concursable'],
        ['id'=>'11', 'nombre'=>'Publicación'],
        ['id'=>'12', 'nombre'=>'Spinoff'],
        ['id'=>'13', 'nombre'=>'Subarea'],
        ['id'=>'14', 'nombre'=>'Transferencia tecnológica'],
        ['id'=>'15', 'nombre'=>'Tutoría'],
        ['id'=>'16', 'nombre'=>'Vinculación'],
        ['id'=>'17', 'nombre'=>'Investigación']
			]);
    }
}
