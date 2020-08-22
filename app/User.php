<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
  protected $table = 'user';

  protected $fillable = ['nombres', 'apellidoPaterno', 'apellidoMaterno', 'email', 'rut'];

  protected $hidden = ['password', 'remember_token'];
}
