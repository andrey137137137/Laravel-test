<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Mail as MyMale;

class UserController extends ApplicationController
{
  protected $view = 'form';
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

  public function index() {
    return view($this->view)->with('header', 'Отправить заявку');
  }

  public function insert(Request $request) {
    $this->validate($request, [
      'user_id' => 'required',
      'theme' => 'required|max:255|unique:applications,theme',
      'message' => 'required']
    );

    $application = new $this->appModelName;
    $application->fill($request->all());
    // $application->save();

    if ($application->save()) {
      $name = $application->theme;
      $message = $application->message;
      $email = $application->user->email;
      Mail::to('to_mail@mail.com')->send(new MyMale($name, $email, $message));
    }

    return redirect($this->redirectTo);
  }
}
