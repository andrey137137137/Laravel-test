<?php

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
   * Undocumented function
   *
   * @return void
   */
  public function role() {
    return $this->belongsTo(Role::class);
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function applications() {
    return $this->hasMany(Application::class);
  }
}
