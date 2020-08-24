<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutoria extends Model{
    protected $table = 'tutoria';

    protected $fillable = ['nombre'];

    public function actividad() {
        return $this->belongsTo('App\Actividad');
    }
}
