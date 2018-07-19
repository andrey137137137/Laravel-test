<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;

class ApplicationController extends Controller
{
  protected $view = 'home';
  protected $redirectTo = '/';
  protected $appModelName = 'App\Application';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index() {
    return view($this->view)->with('header', 'Главная');
  }
}
