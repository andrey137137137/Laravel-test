<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use Mail;

class HomeController extends Controller
{
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

  public function form() {
    return view('form')->with('header', 'Отправить заявку');
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

    // if ($application->save()) {
    //   $from = 'andrey27x777@gmail.com';

    //   Mail::send(['text' => 'mail'], ['name', 'Test Application'], function ($message)
    //   {
    //     $message->to();
    //   });
    // }

    return redirect('/application/form');
  }

  public function delete(Application $application)
  {
    $application->delete();

    return redirect('/');
  }

}
