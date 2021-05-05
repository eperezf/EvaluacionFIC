<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comitecomision extends Model
{
    protected $table = "comitecomision";

    protected $fillable = ["nombre"];

    public function actividad()
    {
        return $this->belongsToMany("App\Actividad");
    }
}
