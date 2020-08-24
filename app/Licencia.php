<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licencia extends Model{
    protected $table = 'licencia';

    protected $fillable = ['nombre','empresa'];

    public function actividad() {
        return $this->belongsTo('App\Actividad');
    }
}
