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
  public $intervalBetweenSending = 1;
  // public $intervalBetweenSending = 1440;

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

    if ($fields) {

      $latestDate = Carbon::createFromTimeString($fields->created_at);
      $now = Carbon::now();

      if ($now->diffInMinutes($latestDate) < $this->intervalBetweenSending) {

        $availableDate = clone $latestDate;
        $availableDate->addMinutes($this->intervalBetweenSending);
        $restTime = $now->diffForHumans($availableDate, true);

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
      SendUserMailJob::dispatch([
        'id' => $application->id,
        'name' => $application->user->name,
        'from' => $application->user->email,
        'theme' => $application->theme,
        'msg' => $application->message
      ]);
    }

    return redirect($this->redirectTo);
  }
}
