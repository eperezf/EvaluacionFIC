<?php

use Illuminate\Database\Seeder;

class TipoPublicacionSeeder extends Seeder
{
    public function run()
    {
        DB::table('tipo_publicacion')->insert([
            ['id' => '1', 'nombre' => 'Científica']
        ]);
    }
}
