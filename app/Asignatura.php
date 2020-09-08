<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model{
    protected $table = 'asignatura';

    protected $fillable = ['nombre','codigo'];

    public function actividad() {
        return $this->belongsToMany('App\Actividad')->using('App\Actividad_asignatura');
    }

    public function curso() {
        return $this->hasMany('App\Curso');
    }

    public function subarea() {
        return $this->belongsTo('App\Subarea');
    }
}
