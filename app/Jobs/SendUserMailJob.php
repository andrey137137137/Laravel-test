<?php

namespace App\Jobs;

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
   * Undocumented variable
   *
   * @var array
   */
  private $params = ['id' => 0, 'name' => '', 'from' => '', 'theme' => '', 'msg' => ''];

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($params)
  {
    foreach ($this->params as $key => $value) {
      if (isset($params[$key])) {
        $this->params[$key] = $params[$key];
      }
    }
  }

  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle()
  {
    Mail::to('to_mail@mail.com')->send(new ApplicationMail($this->params));
  }
}
