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
   * @var array
   */
  private $params = ['name' => '', 'email' => '', 'msg' => ''];

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($params)
  {
    $this->params = $params;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->from($this->params['email'])->view('mail.application')->with($this->params)->subject('Новое письмо');
  }
}
