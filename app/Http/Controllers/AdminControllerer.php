<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminControllerer extends ApplicationController
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
