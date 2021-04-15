<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vinculacion extends Model{
    protected $table = 'vinculacion';

    protected $fillable = ['detalle'];
    
    public function actividad() {
        return $this->belongsTo('App\Actividad');
    }
}
