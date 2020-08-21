<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadAreaTable extends Migration {
  public function up() {
    Schema::create('actividad_area', function (Blueprint $table) {
      $table->id();
      $table->foreignId('idactividad')->references('id')->on('actividad');
      $table->foreignId('idarea')->references('id')->on('area');
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('actividad_area');
  }
}
