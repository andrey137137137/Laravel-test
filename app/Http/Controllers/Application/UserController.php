<?php

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;
use App\Jobs\SendUserMailJob;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{
  /**
   * Undocumented variable
   *
   * @var integer
   */
  public $intervalBeetwenSending = 0;
  // public $intervalBeetwenSending = 1440;

  /**
   * Undocumented variable
   *
   * @var string
   */
  protected $view = 'form';

  /**
   * Undocumented variable
   *
   * @var string
   */
  protected $redirectTo = 'application/form';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->middleware('user');
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function index() {
    $application = new $this->appModelName;
    $fields = $application::where('user_id', Auth::user()->id)->latest('id')->first();

    // dump($fields);

    if ($fields) {

      $latestDate = Carbon::createFromTimeString($fields->created_at);

      $interval = $this->intervalBeetwenSending;
      $now = Carbon::now();
      $diff = $now->diffInMinutes($latestDate);

      // dump($latestDate);
      // dump($now);
      // dump($diff);

      if ($diff < $interval) {
        $availableDate = clone $latestDate;
        $availableDate->addMinutes($interval);
        $restTime = $now->diffForHumans($availableDate, true);
    
        // dump($availableDate);

        return view('alert')->with(['header' => 'Подождите пожалуйста ' . $restTime, 'restTime' => $restTime]);
      }
    }

    return view($this->view)->with('header', 'Отправить заявку');
  }

  /**
   * Undocumented function
   *
   * @param Request $request
   * @return void
   */
  public function insert(Request $request) {
    $this->validate($request, [
      'user_id' => 'required',
      'theme' => 'required|max:255|unique:applications,theme',
      'message' => 'required']
    );

    $application = new $this->appModelName;
    $application->fill($request->all());
    $application->created_at = Carbon::now();

    if ($application->save()) {
      SendUserMailJob::dispatch(
        $application->id, 
        [
          'name' => $application->theme,
          'msg' => $application->message,
          'email' => $application->user->email
        ]
      );
    }

    return redirect($this->redirectTo);
  }
}
