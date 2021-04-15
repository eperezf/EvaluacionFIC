<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministracionacademicaTable extends Migration
{
    public function up()
    {
        Schema::create('administracionacademica', function (Blueprint $table) {
            $table->id();
            $table->string('programa', 128);
            $table->string('comentario', 256)->nullable();
            $table->string('meses', 10);
            $table->foreignId('idactividad')->references('id')->on('actividad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administracionacademica');
    }
}
