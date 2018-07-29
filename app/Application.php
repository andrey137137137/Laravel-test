<?php

/**
 * Модель для таблицы Applications
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
  /**
   * Определяет автоматическую обработку отметок времени в модели.
   *
   * @var boolean
   */
  public $timestamps = false;

  /**
   * Undocumented variable
   *
   * @var array
   */
  protected $fillable = ['user_id', 'theme', 'message'];

  /**
   * Связь с таблицей Users многие к одному.
   *
   * @return Illuminate\Database\Eloquent\Model
   */
  public function user() {
    return $this->belongsTo(User::class);
  }
}
