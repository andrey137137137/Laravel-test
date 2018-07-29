<?php

namespace App\Http\Controllers\Application;

class ManagerController extends Controller
{
  /**
   * Представление, которое увидит
   * менеджер после авторизации.
   *
   * @var string
   */
  protected $view = 'applications';

  /**
   * Маршрут, на который будет перенаправлен
   * менеджер после авторизации.
   *
   * @var string
   */
  protected $redirectTo = 'applications';

  /**
   * Вызывает родительский конструктор
   * и подключает промежуточный слой
   * для менеджеров.
   *
   * @return void
   */
  public function __construct()
  {
    parent::__construct();
    $this->middleware('manager');
  }

  /**
   * Выводит все не отмеченные как "Прочитано" заявки пользователей.
   *
   * @return Illuminate\View\View
   */
  public function index() {
    $model = $this->appModelName;
    $applications = $model::where('marked', 0)
      ->join('users', 'applications.user_id', '=', 'users.id')
      ->select('applications.*', 'users.name', 'users.email')
      ->get();

    return view($this->view)->with(['applications' => $applications, 'header' => 'Заявки']);
  }

  /**
   * Отмечает заявку как прочитанную.
   *
   * @param integer $application
   * @return Illuminate\View\View
   */
  public function mark($id)
  {
    $model = $this->appModelName;
    $application = $model::find($id);
    $application->marked = 1;
    $application->save();

    return redirect($this->redirectTo);
  }
}
