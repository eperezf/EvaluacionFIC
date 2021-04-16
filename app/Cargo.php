<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model{
    protected $table = 'cargo';

    protected $fillable = ['nombre'];

    public function user() {
        return $this->belongsToMany(
            'App\User',
            'user_actividad',
            'iduser',
            'idcargo')
            ->using('App\User_actividad')
            ->withPivot([
                'bonificacion',
                'calificacion',
                'created_at',
                'updated_at'
            ]);
    }

    public function actividad() {
        return $this->belongsToMany(
            'App\Actividad',
            'idactividad',
            'idcargo')
            ->using('App\User_actividad')
            ->withPivot([
                'bonificacion',
                'calificacion',
                'created_at',
                'updated_at'
            ]);
    }

    public function tipoActividad() {
        return $this->belongsTo('App\Tipoactividad');
    }
}
