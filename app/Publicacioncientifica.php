<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacioncientifica extends Model
{
    protected $table = "publicacioncientifica";

    protected $fillable = [
        "titulo",
        "journal",
        "indexacion"
    ];

    public function actividad()
    {
        return $this->belongsTo('App\Actividad');
    }
}
