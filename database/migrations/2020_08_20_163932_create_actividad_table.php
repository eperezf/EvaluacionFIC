<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadTable extends Migration {
  public function up() {
    Schema::create('actividad', function (Blueprint $table) {
      $table->id();
      $table->foreignId('idtipoactividad')->references('id')->on('tipoactividad');
      $table->date('inicio');
      $table->date('termino');
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('actividad');
  }
}
