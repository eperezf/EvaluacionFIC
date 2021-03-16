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
    return $this->belongsToMany('App\Cargo','user_actividad','idcargo','iduser')
      ->using('App\User_actividad')
      ->withPivot([
        'bonificacion',
        'calificacion',
        'created_at',
        'updated_at'
    ]);
  }

  public function actividad() {
    return $this
      ->belongsToMany('App\Actividad', 'user_actividad', 'iduser', 'idactividad')
      ->using('App\User_actividad')
      ->withPivot([
        'idcargo',
        'bonificacion',
        'calificacion',
        'created_at',
        'updated_at'
      ]);
  }
}
