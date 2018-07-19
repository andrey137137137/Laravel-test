<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class ManagerController extends ApplicationController
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $applications = Application::query()
      ->join('users', 'applications.user_id', '=', 'users.id')
      ->select('applications.*', 'users.name', 'users.email')
      ->get();

    return view('home')->with(['applications' => $applications, 'header' => 'Заявки']);
  }

  public function delete(Application $application)
  {
    $application->delete();

    return redirect('/');
  }
}
