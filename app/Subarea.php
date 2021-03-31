<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subarea extends Model{
    protected $table = 'subarea';

    protected $fillable = ['nombre'];

    public function asignatura()
    {
        return $this->hasMany('App\Asignatura');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function actividad()
    {
        return $this->belongsToMany(
            'App\Actividad',
            'actividad_subarea',
            'idactividad',
            'idsubarea')
            ->using('App\Actividad_subarea')
            ->withPivot([
                'created_at',
                'updated_at'
            ]);
    }
}
