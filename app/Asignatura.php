<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model{
    protected $table = 'asignatura';

    protected $fillable = ['nombre','codigo', 'idsubarea'];

    public function actividad() {
        return $this->belongsToMany(
            'App\Actividad',
            'actividad_asignatura',
            'idactividad',
            'idasignatura')
            ->using('App\Actividad_asignatura')
            ->withPivot([
                'created_at',
                'updated_at'
            ]);
    }

    public function curso() {
        return $this->hasMany('App\Curso');
    }

    public function subarea() {
        return $this->belongsTo('App\Subarea');
    }
}
