<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//Class which implements Illuminate\Contracts\Auth\Authenticatable
use Illuminate\Foundation\Auth\User as Authenticatable;

//Notification for Seller
use App\Notifications\UsuarioResetPasswordNotification;

//Trait for sending notifications in laravel
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

  public $table = "usuario";
  protected $fillable = [
      'username', 
      'email', 
      'password', 
      'ativo', 
      'administrador',
      'id_funcionario',
      'id_advogado'
  ];

  protected $primaryKey = "id_usuario";
  
  public $timestamps = false;
  
   protected $hidden = [
       'password', 'remember_token',
   ];

public function sendPasswordResetNotification($token)
  {
      $this->notify(new UsuarioResetPasswordNotification($token));
  }


}
