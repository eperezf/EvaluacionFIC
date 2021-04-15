<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministracionAcademica extends Model
{
    protected $table = 'administracionadacemica';

    protected $fillable = ['programa', 'meses', 'comentario'];

    public function actividad()
    {
        return $this->belongsTo('App\Actividad');
    }
}
