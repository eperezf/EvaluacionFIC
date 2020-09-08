<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class User_actividad extends Pivot{
    protected $table = 'user_actividad';

    protected $fillable = ['bonificacion'];
}
