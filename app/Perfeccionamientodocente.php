<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfeccionamientodocente extends Model{
    protected $table = 'perfeccionamientodocente';

    protected $fillable = ['nombre','area','institucion'];

    public function actividad() {
        return $this->belongsTo('App\Actividad');
    }
}
