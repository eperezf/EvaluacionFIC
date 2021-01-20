<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutoriaTable extends Migration {
  public function up() {
    Schema::create('tutoria', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 45);
      $table->foreignId('idactividad')->references('id')->on('actividad');
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('tutoria');
  }
}
