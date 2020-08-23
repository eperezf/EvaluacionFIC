<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_actividad extends Model{
    protected $table = 'user_actividad';

    protected $filable = ['bonificacion','calificacion'];
}
