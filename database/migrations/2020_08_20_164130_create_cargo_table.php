<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargoTable extends Migration {
  public function up() {
    Schema::create('cargo', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 45);
      $table->foreignId('idtipoactividad')->references('id')->on('tipoactividad');
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('cargo');
  }
}
