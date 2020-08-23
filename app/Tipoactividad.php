<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoactividad extends Model{
    protected $table = 'tipoactividad';

    protected $fillable = ['nombre'];
}
