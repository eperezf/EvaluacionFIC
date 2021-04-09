<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectoinvestigacion extends Model
{
    protected $table = "proyectoinvestigacion";

    protected $fillable = [
        "nombre",
        "comentario"
    ];

    public function actividad()
    {
        return $this->belongsTo('App\Actividad');
    }

    public function fuenteFinanciamiento()
    {
        return $this->belongsTo('App\Fuentefinanciamiento');
    }
}
