<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fuentefinanciamiento extends Model
{
    protected $table = "fuentefinanciamiento";

    protected $fillable = ["nombre"];

    public function proyectoInvestigacion()
    {
        return $this->hasMany('App/Proyectoinvestigacion');
    }
}
