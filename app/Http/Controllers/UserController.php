<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends ApplicationController
{
  protected $view = 'form';
  protected $redirectTo = 'application-form';

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
    $application->save();

    // if ($application->save()) {
    //   $from = 'andrey27x777@gmail.com';

    //   Mail::send(['text' => 'mail'], ['name', 'Test Application'], function ($message)
    //   {
    //     $message->to();
    //   });
    // }

    return redirect($this->redirectTo);
  }
}
