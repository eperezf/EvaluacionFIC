<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
        TipoActividadSeeder::class,
        CargoSeeder::class,
        AdminUserSeeder::class,
        AdminActividadSeeder::class,
        AdminUserActividadSeeder::class
      ]);
    }
}
