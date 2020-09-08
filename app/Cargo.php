<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model{
    protected $table = 'cargo';

    protected $fillable = ['nombre','peso'];

    public function user() {
        return $this->belongsToMany('App\User')->using('App\User_actividad');
    }

    public function actividad() {
        return $this->belongsToMany('App\Actividad')->using('App\User_actividad');
    }

    public function tipoActividad() {
        return $this->belongsTo('App\Tipoactividad');
    }
}
