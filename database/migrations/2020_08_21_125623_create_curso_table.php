<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('idomega');
            $table->float('calificacion')->nullable();
            $table->unsignedInteger('respuestas')->nullable();
            $table->unsignedInteger('inscritos')->nullable();
            $table->boolean('material');
            $table->unsignedInteger('seccion');
            $table->string('sede', 45);
            $table->foreignId('idactividad')->references('id')->on('actividad');
            $table->foreignId('idasignatura')->references('id')->on('asignatura');
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
        Schema::dropIfExists('curso');
    }
}
