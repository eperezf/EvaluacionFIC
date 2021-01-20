<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadAsignaturaTable extends Migration {
  public function up() {
    Schema::create('actividad_asignatura', function (Blueprint $table) {
      $table->id();
      $table->foreignId('idactividad')->references('id')->on('actividad');
      $table->foreignId('idasignatura')->references('id')->on('asignatura');
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('actividad_asignatura');
  }
}
