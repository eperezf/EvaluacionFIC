<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'area';

    protected $fillable = ['nombre'];

    public function subarea()
    {
        return $this->hasMany('App\Subarea');
    }

    public function actividad()
    {
        return $this->belongsToMany(
            'App\Actividad',
            'actividad_area',
            'idactividad',
            'idarea')
            ->using('App\Actividad_area')
            ->withPivot([
                'created_at',
                'updated_at'
            ]);
    }
}
