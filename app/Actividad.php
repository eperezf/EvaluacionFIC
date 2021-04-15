<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model {
    protected $table = 'actividad';

    protected $fillable = [
        'inicio',
        'termino',
        'idtipoactividad'
    ];

    //Relations
    public function publicacion()
    {
        return $this->hasMany('App\Publicacion');
    }

    public function libro()
    {
        return $this->hasMany('App\Libro');
    }

    public function transTecnologica()
    {
        return $this->hasMany('App\Transferenciatecnologica');
    }

    public function vinculacion()
    {
        return $this->hasMany('App\Vinculacion');
    }

    public function perfDocente()
    {
        return $this->hasMany('App\Perfeccionamientodocente');
    }

    public function proyectoConcursable()
    {
        return $this->hasMany('App\Proyectoconcursable');
    }

    public function licencia()
    {
        return $this->hasMany('App\Licencia');
    }

    public function spinoff()
    {
        return $this->hasMany('App\Spinoff');
    }

    public function tutoria()
    {
        return $this->hasMany('App\Tutoria');
    }

    public function curso()
    {
        return $this->hasMany('App\Curso');
    }
    
    public function asignatura()
    {
        return $this
            ->belongsToMany('App\Asignatura', 'actividad_asignatura', 'idasignatura', 'idactividad')
            ->using('App\Actividad_asignatura')
            ->withPivot([
                'created_at',
                'updated_at'
            ]);
    }

    public function area()
    {
        return $this
            ->hasMany('App\Area', 'actividad_area', 'idarea', 'idactividad')
            ->using('App\Actividad_area')
            ->withPivot([
                'created_at',
                'updated_at'
            ]);
    }

    public function subarea()
    {
        return $this
            ->hasMany('App\Subarea', 'actividad_subarea', 'idsubarea', 'idactividad')
            ->using('App\Actividad_subarea')
            ->withPivot([
                'created_at',
                'updated_at'
            ]);
    }

    public function user()
    {
        return $this
            ->belongsToMany('App\User', 'user_actividad', 'iduser', 'idactividad')
            ->using('App\User_actividad')
            ->withPivot([
                'bonificacion',
                'calificacion',
                'created_at',
                'updated_at'
            ]);
    }

    public function cargo()
    {
        return $this
            ->belongsToMany('App\Cargo', 'user_actividad', 'iduser', 'idcargo')
            ->using('App\User_actividad')
            ->withPivot([
                'bonificacion',
                'calificacion',
                'created_at',
                'updated_at'
            ]);
    }

    public function tipoactividad()
    {
        return $this->belongsTo('App\Tipoactividad');
    }

    public function publicacionCientifica()
    {
        return $this->hasMany('App\Publicacioncientifica');
    }

    public function patente()
    {
        return $this->hasMany('App\Patente');
    }

    public function guiaTesis()
    {
        return $this->hasMany('App\Guiatesis');
    }

    public function proyectoInvestigacion()
    {
        return $this->hasMany('App\Proyectoinvestigacion');
    }

    public function administracionAcademica()
    {
        return $this->hasMany('App\AdministracionAcademica');
    }
}
