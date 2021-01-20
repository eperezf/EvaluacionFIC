<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroTable extends Migration {
  public function up() {
    Schema::create('libro', function (Blueprint $table) {
      $table->id();
      $table->string('titulo', 45);
      $table->string('isbn', 45);
      $table->foreignId('idactividad')->references('id')->on('actividad');
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('libro');
  }
}
