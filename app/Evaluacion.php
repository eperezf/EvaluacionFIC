<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = 'evaluacion';

    protected $fillable = ['periodo', 'comentario', 'nota'];

    public function user()
    {
        return $this->hasOne('App\User', 'iduser');
    }
}
