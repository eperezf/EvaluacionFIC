<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_Publicacion extends Model
{
    protected $table = 'tipo_publicacion';

    protected $fillable = ['nombre'];

    public function publicacion()
    {
        return $this->hasMany('App\Publicacion');
    }
}
