<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patente', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 128);
            $table->string('numeroregistro', 64);
            $table->date('fecharegistro');
            $table->date('fechaconcedida');
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
        Schema::dropIfExists('patente');
    }
}
