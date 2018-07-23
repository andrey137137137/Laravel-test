<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;

class ApplicationController extends Controller
{
  /**
   * Undocumented variable
   *
   * @var string
   */
  protected $view = 'home';

  /**
   * Undocumented variable
   *
   * @var string
   */
  protected $redirectTo = '/';

  /**
   * Undocumented variable
   *
   * @var string
   */
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

  /**
   * Undocumented function
   *
   * @return void
   */
  public function index() {
    return view($this->view)->with('header', 'Главная');
  }
}
