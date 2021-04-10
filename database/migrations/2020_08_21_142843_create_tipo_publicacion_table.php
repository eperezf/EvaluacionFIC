<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoPublicacionTable extends Migration
{
    public function up()
    {
        Schema::create('tipo_publicacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_publicacion');
    }
}
