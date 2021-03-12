<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $table = 'evaluacion';

    protected $fillable = ['fecha', 'comentario', 'nota'];

    public function user()
    {
        return $this->hasOne('App\User', 'iduser');
    }
}
