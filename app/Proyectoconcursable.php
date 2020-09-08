<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectoconcursable extends Model{
    protected $table = 'proyectoconcursable';

    protected $fillable = ['nombre'];

    public function actividad() {
        return $this->belongsTo('App\Actividad');
    }
}
