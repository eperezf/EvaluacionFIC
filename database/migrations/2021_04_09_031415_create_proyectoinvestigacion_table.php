<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoinvestigacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectoinvestigacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 128);
            $table->string('comentario', 256)->nullable();
            $table->foreignId('idactividad')->references('id')->on('actividad');
            $table->foreignId('idfuentefinanciamiento')->references('id')->on('fuentefinanciamiento');
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
        Schema::dropIfExists('proyectoinvestigacion');
    }
}
