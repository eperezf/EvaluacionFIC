<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubareaTable extends Migration {
  public function up() {
    Schema::create('subarea', function (Blueprint $table) {
      $table->id();
      $table->string('nombre', 45);
      $table->foreignId('idarea')->references('id')->on('area');
      $table->timestamps();


    });
  }
  public function down() {
    Schema::dropIfExists('subarea');
  }
}
