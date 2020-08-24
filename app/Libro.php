<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model{
    protected $table = 'libro';
    
    protected $fillable = ['titulo','isbn'];

    public function actividad() {
        return $this->belongsTo('App\Actividad');
    }
}
