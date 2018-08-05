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
  private $params = ['theme' => 'Ошибка!', 'msg' => 'Произошла ошибка при отправке почты от клиента к менеджеру.'];

  /**
   * Заполнение $this->params, адресса и имени
   * пользователя, от которого отсылается письмо.
   *
   * @return void
   */
  public function __construct($params)
  {
    $this->id = $params['id'];
    $subject = 'Ошибка!';

    if (isset($params['from'])) {
      $name = isset($params['name']) ? $params['name'] : null;
      $subject = $params['id'] ? 'Заявка №' . $this->id : 'Нет темы';
      $this->from($params['from'], $name);
    }

    $this->subject($subject);

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
    return $this->view('mail.application')->with($this->params);
  }
}
