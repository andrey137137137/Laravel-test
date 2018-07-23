<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  /**
   * Undocumented function
   *
   * @return void
   */
  public function users() {
    return $this->hasMany(User::class);
  }
}
