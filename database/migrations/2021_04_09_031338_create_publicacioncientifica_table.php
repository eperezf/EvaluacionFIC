<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacioncientificaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacioncientifica', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 256);
            $table->string('journal', 64);
            $table->string('indexacion', 16);
            $table->foreignId('idactividad')->references('id')->on('actividad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicacioncientifica');
    }
}
