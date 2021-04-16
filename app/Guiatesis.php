<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guiatesis extends Model
{
    protected $table = "guiatesis";

    protected $fillable = [
        "estudiantes",
        "comentario"
    ];

    public function actividad()
    {
        return $this->belongsTo('App\Actividad');
    }

    public function programa()
    {
        return $this->belongsTo('App\Programa');
    }
}
