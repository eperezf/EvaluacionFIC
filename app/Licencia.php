<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licencia extends Model{
    protected $table = 'licencia';

    protected $fillable = ['nombre','empresa'];
}
