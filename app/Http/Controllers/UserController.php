<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendUserMailJob;

class UserController extends ApplicationController
{
  /**
   * Undocumented variable
   *
   * @var string
   */
  protected $view = 'form';

  /**
   * Undocumented variable
   *
   * @var string
   */
  protected $redirectTo = 'application-form';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->middleware('user');
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function index() {
    return view($this->view)->with('header', 'Отправить заявку');
  }

  /**
   * Undocumented function
   *
   * @param Request $request
   * @return void
   */
  public function insert(Request $request) {
    $this->validate($request, [
      'user_id' => 'required',
      'theme' => 'required|max:255|unique:applications,theme',
      'message' => 'required']
    );

    $application = new $this->appModelName;
    $application->fill($request->all());

    if ($application->save()) {
      $name = $application->theme;
      $message = $application->message;
      $email = $application->user->email;
      SendUserMailJob::dispatch($name, $email, $message);
    }

    return redirect($this->redirectTo);
  }
}
