<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transferenciatecnologica extends Model{
    protected $table = 'transferenciatecnologica';

    protected $fillable = ['nombre','empresa'];

    public function actividad() {
        return $this->belongsTo('App\Actividad');
    }
}
