<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignaturaTable extends Migration {
  public function up() {
    Schema::create('asignatura', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 512);
      $table->string('codigo', 45);
      $table->foreignId('idsubarea')->references('id')->on('subarea');
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('asignatura');
  }
}
