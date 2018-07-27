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
   * Undocumented variable
   *
   * @var integer
   */
  private $id;

  /**
   * Undocumented variable
   *
   * @var array
   */
  private $params = ['theme' => '', 'msg' => ''];

  /**
   * Create a new message instance.
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
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->view('mail.application')->with($this->params)->subject('Заявка №' . $this->id);
  }
}
