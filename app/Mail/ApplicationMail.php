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
   * @var [type]
   */
  protected $name;
  
  /**
   * Undocumented variable
   *
   * @var [type]
   */
  protected $email;
  
  /**
   * Undocumented variable
   *
   * @var [type]
   */
  protected $message;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($name, $email, $message)
  {
    $this->name = $name;
    $this->email = $email;
    $this->message = $message;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    // return $this->view('mail.application')->with(['name' => $this->name, 'email' => $this->email, 'message' => $this->message])->subject('Новое письмо');
    // var_dump($this->message);
    return $this->view('mail.application')->with(['name' => $this->name, 'email' => $this->email, 'msg' => $this->message]);
  }
}
