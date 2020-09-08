<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoactividad extends Model{
    protected $table = 'tipoactividad';

    protected $fillable = ['nombre'];
    
    public function cargo() {
        return $this->hasMany('App\Cargo');
    }

    public function actividad() {
        return $this->hasMany('App\Actividad');
    }
}
