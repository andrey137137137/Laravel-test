<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
  /**
   * Undocumented variable
   *
   * @var array
   */
  protected $fillable = ['user_id', 'theme', 'message'];

  /**
   * Undocumented function
   *
   * @return void
   */
  public function user() {
    return $this->belongsTo(User::class);
  }
}
