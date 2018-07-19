<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class ManagerController extends ApplicationController
{
  protected $view = 'applications';
  protected $redirectTo = 'applications';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->middleware('manager');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $model = $this->appModelName;
    $applications = $model::query()
      ->join('users', 'applications.user_id', '=', 'users.id')
      ->select('applications.*', 'users.name', 'users.email')
      ->get();

    return view($this->view)->with(['applications' => $applications, 'header' => 'Заявки']);
  }

  public function delete(\App\Application $application)
  {
    $application->delete();

    return redirect($this->redirectTo);
  }
}
