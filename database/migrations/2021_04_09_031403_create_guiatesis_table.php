<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiatesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guiatesis', function (Blueprint $table) {
            $table->id();
            $table->string('estudiante', 128);
            $table->string('comentario', 256)->nullable();
            $table->foreignId('idactividad')->references('id')->on('actividad');
            $table->foreignId('idprograma')->references('id')->on('programa');
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
        Schema::dropIfExists('guiatesis');
    }
}
