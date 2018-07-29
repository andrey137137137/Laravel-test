<?php

/**
 * Модель для таблицы Users
 */

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password', 'role_id'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'rule', 'password', 'remember_token'
  ];

  /**
   * Связь с таблицей Roles многие к одному.
   *
   * @return Illuminate\Database\Eloquent\Model
   */
  public function role() {
    return $this->belongsTo(Role::class);
  }

  /**
   * Связь с таблицей Applications один ко многим.
   *
   * @return Illuminate\Database\Eloquent\Model
   */
  public function applications() {
    return $this->hasMany(Application::class);
  }
}
