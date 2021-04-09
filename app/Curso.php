<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model{
    protected $table = 'curso';

    protected $fillable = [
        'idomega',
        'calificacion',
        'respuestas',
        'material',
        'seccion',
        'inscritos',
        'idasignatura',
        'idactividad',
        'sede'
    ];

    public function actividad() {
        return $this->belongsTo('App\Actividad');
    }

    public function asignatura() {
        return $this->belongsTo('App\Asignatura');
    }
}
