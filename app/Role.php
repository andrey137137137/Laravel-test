<?php

/**
 * Модель для таблицы Roles
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  /**
   * Связь с таблицей Users один ко многим.
   *
   * @return Illuminate\Database\Eloquent\Model
   */
  public function users() {
    return $this->hasMany(User::class);
  }
}
