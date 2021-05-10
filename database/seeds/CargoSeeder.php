<?php

use JeroenZwart\CsvSeeder\CsvSeeder;

class CargoSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeds/csvs/cargos.csv';
        $this->tablename = 'cargo';
        $this->truncate = FALSE;
        $this->mapping = ['nombre', 'idtipoactividad'];
        $this->delimiter = ',';
        $this->aliases = ['CARGO' => 'nombre', 'ID_TIPO_ACTIVIDAD' => 'idtipoactividad'];
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
