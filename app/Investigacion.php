<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investigacion extends Model
{
    protected $table = 'investigacion';

    public function actividad()
    {
        return $this->belongsTo('App\Actividad');
    }
}
