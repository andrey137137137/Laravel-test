<?php

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;
use App\Jobs\SendUserMailJob;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{
  /**
   * Представление, которое увидит
   * пользователь после авторизации.
   *
   * @var string
   */
  protected $view = 'form';

  /**
   * Маршрут, на который будет перенаправлен
   * пользователь после авторизации.
   *
   * @var string
   */
  protected $redirectTo = 'application/form';

  /**
   * Допустимый интервал между
   * отправками заявок.
   *
   * @var integer
   */
  private $intervalBetweenSending = 1440;

  /**
   * Вызывает родительский конструктор
   * и подключает промежуточный слой для
   * обычных авторизированных пользователей.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->middleware('user');
  }

  /**
   * Выбирает дату создания последней записи таблицы Applications,
   * где поле 'user_id' равно id текущего пользователя.
   * Если записи нету, то возвращается представление формы отправки заявки.
   * Если запись есть, то с помощью переменной $this->intervalBetweenSending
   * вычисляется сколько осталось времени до следующей возможности отправить
   * заявку и возвращается представление с сообщением об оставшемся времени.
   *
   * @return Illuminate\View\View
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
   * Проверяет все ли заполнены свойства объекта $request и в случае успеха
   * добавляет заявку в таблицу Applications. В случае успешного добавления
   * заявки в таблицу создаётся задача для очереди App\Jobs\SendUserMailJob.
   *
   * @param Request $request
   * @return Illuminate\View\View
   */
  public function insert(Request $request) {
    $this->validate($request, [
      'user_id' => 'required',
      'theme' => 'required',
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
