<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoactividadTable extends Migration {
  public function up() {
    Schema::create('tipoactividad', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 45);
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('tipoactividad');
  }
}
