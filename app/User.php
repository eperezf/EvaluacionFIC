<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
  protected $table = 'user';

  protected $fillable = [
    'nombres',
    'apellidoPaterno',
    'apellidoMaterno',
    'email',
    'rut'
  ];

  protected $hidden = ['password', 'remember_token'];

  public function cargo() {
    return $this->belongsToMany('App\Cargo')->using('App\User_actividad');
  }

  public function actividad() {
    return $this->belongsToMany('App\Actividad')->using('App\User_actividad');
  }
}
