<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
  protected $table = 'user';
  use Notifiable;
  protected $fillable = [
    'nombres',
    'apellidoPaterno',
    'apellidoMaterno',
    'email',
    'rut',
    'password'
  ];

  protected $hidden = ['password', 'remember_token'];

  protected $casts = ['email_verified_at' => 'datetime'];

  public function cargo() {
    return $this->belongsToMany('App\Cargo')->using('App\User_actividad');
  }

  public function actividad() {
    return $this->belongsToMany('App\Actividad')->using('App\User_actividad');
  }
}
