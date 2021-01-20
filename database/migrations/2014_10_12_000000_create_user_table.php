<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration {
  public function up() {
    Schema::create('user', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->id();
      $table->string('nombres', 45);
      $table->string('apellidoPaterno', 45);
      $table->string('apellidoMaterno', 45)->nullable();
      $table->string('email', 45)->unique();
      $table->string('rut', 45)->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
    });
  }
  public function down() {
    Schema::dropIfExists('user');
  }
}
