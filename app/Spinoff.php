<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spinoff extends Model{
    protected $table = 'spinoff';

    protected $fillable = ['nombre'];
}
