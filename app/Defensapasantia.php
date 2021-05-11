<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Defensapasantia extends Model
{
    protected $table = "defensapasantia";

    protected $fillable = ["tipo", "numerodefensas"];

    public function actividad()
    {
        return $this->belongsToMany("App\Actividad");
    }
}
