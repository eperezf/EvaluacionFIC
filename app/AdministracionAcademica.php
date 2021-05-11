<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdministracionAcademica extends Model
{
    protected $table = 'administracionacademica';

    protected $fillable = ['actividad', 'programa', 'meses', 'comentario'];

    public function actividad()
    {
        return $this->belongsTo('App\Actividad');
    }
}
