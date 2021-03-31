<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class AsignaturaPostgradoSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/csvs/asignaturas_postgrado.csv';
        $this->tablename = 'asignatura';
        $this->truncate = FALSE;
        $this->mapping = ['codigo', 'nombre', 'idsubarea'];
        $this->delimiter = ',';
        $this->aliases = ['SIGLA' => 'codigo', 'ASIGNATURA' => 'nombre', 'ID_SUBAREA' => 'idsubarea'];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        parent::run();
    }
}
