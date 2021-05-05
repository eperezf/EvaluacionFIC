<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admisiondifusion extends Model
{
    protected $table = "admisioncomision";

    protected $fillable = ["nombre", "tipo"];

    public function actividad()
    {
        return $this->belongsToMany("App\Actividad");
    }
}
