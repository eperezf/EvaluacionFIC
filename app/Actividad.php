<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model {
    protected $table = 'actividad';

    protected $fillable = ['inicio','termino'];

    //Relations
    //Faltan por terminar
    public function publicacion() { //
        return $this->hasMany('App\Publicacion');
    }

    public function libro() { //
        return $this->hasMany('App\Libro');
    }

    public function transTecnologica() { //
        return $this->hasMany('App\Transferenciatecnologica');
    }

    public function vinculacion() { //
        return $this->hasMany('App\Vinculacion');
    }

    public function perfDocente() { //
        return $this->hasMany('App\Perfeccionamientodocente');
    }

    public function proyectoConcursable() { //
        return $this->hasMany('App\Proyectoconcursable');
    }

    public function licencia() { //
        return $this->hasMany('App\Licencia');
    }

    public function spinoff() { //
        return $this->hasMany('App\Spinoff');
    }

    public function tutoria() { //
        return $this->hasMany('App\Tutoria');
    }
}
