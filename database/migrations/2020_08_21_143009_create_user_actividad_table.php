<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActividadTable extends Migration {
  public function up() {
    Schema::create('user_actividad', function (Blueprint $table) {
      $table->id();
      $table->foreignId('iduser')->references('id')->on('user');
      $table->foreignId('idactividad')->references('id')->on('actividad');
      $table->foreignId('idcargo')->references('id')->on('cargo');
      $table->string('comentario', 512)->nullable();
      $table->float('bonificacion')->nullable();
      $table->float('calificacion')->nullable();
      $table->float('carga')->nullable();
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('user_actividad');
  }
}
