<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVinculacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 256);
            $table->string('detalle', 1024);
            $table->string('periodo', 64);
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
        Schema::dropIfExists('vinculacion');
    }
}
