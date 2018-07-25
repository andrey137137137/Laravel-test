<?php

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;
use App\Application;
use Carbon\Carbon;

class Controller extends \App\Http\Controllers\Controller
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
    Carbon::setLocale('ru');
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
