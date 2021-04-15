<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionTable extends Migration {
  public function up() {
    Schema::create('publicacion', function (Blueprint $table) {
      $table->id();
      $table->foreignId('idTipoPublicacion')->references('id')->on('tipo_publicacion');
      $table->string('titulo', 45);
      $table->string('volumen', 45);
      $table->string('issue', 45);
      $table->string('pages', 45);
      $table->string('issn', 45);
      $table->string('doi', 45);
      $table->string('notas', 45);
      $table->string('revista', 45);
      $table->string('tipoRevista', 45);
      $table->string('publisher', 45);
      $table->string('abstract', 45);
      $table->string('indexacion', 45);
      $table->foreignId('idactividad')->references('id')->on('actividad');
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('publicacion');
  }
}
