<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationMail;

class SendUserMailJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Количество попыток выполнения задания.
   *
   * @var integer
   */
  public $tries = 3;

  /**
   * Массив с допустимыми переменными
   *
   * @var array
   */
  private $params = [
    'id' => 0,
    'name' => null,
    'from' => null,
    'theme' => 'Ошибка!',
    'msg' => 'Произошла ошибка при отправке почты от клиента к менеджеру.'
  ];

  /**
   * Маска для адресса письма.
   *
   * @var string
   */
  private $fromPattern = '/^[[:alnum:]._]{6,}@[[:alpha:]]{3,}(\.[[:alpha:]]{2,})+$/i';

  /**
   * Создание задания для очереди.
   * Проверка в $params допустимых переменных
   * и заполнение $this->params.
   *
   * @return void
   */
  public function __construct($params = [])
  {
    foreach ($this->params as $key => $value) {
      if (!isset($params[$key])) {
        continue;
      }

      if ($key == 'id' && is_int($params[$key])) {
        $value = $params[$key];
      } elseif ($key == 'from' && preg_match($this->fromPattern, $params[$key]) === 1) {
        $value = $params[$key];
      } elseif (is_string($params[$key])) {
        $value = $params[$key];
      }

      $this->params[$key] = $value;
    }
  }

  /**
   * Отправляет с помощью Illuminate\Support\Facades\Mail
   * письмо на почту to_mail@mail.com.
   *
   * @return void
   */
  public function handle()
  {
    Mail::to('to_mail@mail.com')->send(new ApplicationMail($this->params));
  }

  public function failed(Exception $exception)
  {
    info(__CLASS__ . ' ошибка выполнения');
    info($this->params);
  }
}
