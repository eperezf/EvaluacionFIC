<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model{
    protected $table = 'curso';

    protected $fillable = ['calificacion','respuestas','material','seccion'];
}
