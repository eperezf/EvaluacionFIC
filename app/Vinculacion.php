<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vinculacion extends Model{
    protected $table = 'vinculacion';

    protected $fillable = ['nombre','descripcion'];
}
