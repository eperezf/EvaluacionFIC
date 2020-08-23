<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model{
    protected $table = 'asignatura';

    protected $fillable = ['nombre','codigo'];
}
