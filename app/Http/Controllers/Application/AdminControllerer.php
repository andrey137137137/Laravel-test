<?php

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;

class AdminControllerer extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->middleware('admin');
  }
}
