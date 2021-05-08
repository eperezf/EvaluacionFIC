<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admisiondifusion extends Model
{
    protected $table = "admisiondifusion";

    protected $fillable = ["nombre", "tipo"];

    public function actividad()
    {
        return $this->belongsToMany("App\Actividad");
    }
}
