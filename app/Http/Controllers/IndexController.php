<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;

class IndexController extends Controller
{

  public function index() {
    return view('index')->with(['applications' => Application::all(), 'header' => 'Заявки']);
  }

  public function add() {
    return view('add')->with('header', 'Отправить заявку');
  }

  public function insert(Request $request) {
    $this->validate($request, [
      'user_id' => 'required',
      'theme' => 'required|max:255|unique:applications,theme',
      'message' => 'required']
    );

    $application = new Application;
    $application->fill($request->all());
    $application->save();

    return redirect('/');
  }

  public function delete(Application $application)
  {
    $application->delete();

    return redirect('/');
  }

}
