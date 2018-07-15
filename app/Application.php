<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
  protected $fillable = ['user_id', 'theme', 'message'];
}
