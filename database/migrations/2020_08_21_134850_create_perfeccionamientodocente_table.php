<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfeccionamientodocenteTable extends Migration {
  public function up() {
    Schema::create('perfeccionamientodocente', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 45);
      $table->string('area', 45);
      $table->string('institucion', 45);
      $table->foreignId('idactividad')->references('id')->on('actividad');
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('perfeccionamientodocente');
  }
}
