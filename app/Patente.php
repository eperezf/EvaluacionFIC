<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patente extends Model
{
    protected $table = "patente";

    protected $fillable = [
        "titulo",
        "numeroregistro",
        "fecharegistro",
        "fechaconcedida"
    ];

    public function actividad()
    {
        return $this->belongsTo('App\Actividad');
    }
}
