<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
  protected $fillable = ['user_id', 'theme', 'message'];

  public function user() {
    return $this->belongsTo(User::class);
  }
}
