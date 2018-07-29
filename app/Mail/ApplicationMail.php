<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplicationMail extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Идентификатор таблицы Applications,
   * который используется как номер заявки.
   *
   * @var integer
   */
  private $id;

  /**
   * Параметры, которые отправляются в представление.
   *
   * @var array
   */
  private $params = ['theme' => '', 'msg' => ''];

  /**
   * Заполнение $this->params, адресса и имени
   * пользователя, от которого отсылается письмо.
   *
   * @return void
   */
  public function __construct($params)
  {
    $this->id = isset($params['id']) ? $params['id'] : 0;

    if (isset($params['from'])) {
      $name = isset($params['name']) ? $params['name'] : null;
      $this->from($params['from'], $name);
    }

    foreach ($this->params as $key => $value) {
      if (isset($params[$key])) {
        $this->params[$key] = $params[$key];
      }
    }
  }

  /**
   * Создание сообщения.
   *
   * @return $this
   */
  public function build()
  {
    return $this->view('mail.application')->with($this->params)->subject('Заявка №' . $this->id);
  }
}
