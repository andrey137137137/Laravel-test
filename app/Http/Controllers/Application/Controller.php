<?php

/**
 * Промежуточный контроллер, от которого наследуются
 * другие контроллеры, связанные с моделью App\Application.
 */

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;
use Carbon\Carbon;

class Controller extends \App\Http\Controllers\Controller
{
  /**
   * Представление, по умолчанию,
   * которое увидит пользователь
   * после авторизации.
   *
   * @var string
   */
  protected $view = 'home';

  /**
   * Маршрут, по умолчанию,
   * на который будет перенаправлен
   * пользователь после авторизации.
   *
   * @var string
   */
  protected $redirectTo = '/';

  /**
   * Название модели заявок вместе с
   * пространством имён. Чтобы имя хранилось
   * в одном месте.
   *
   * @var string
   */
  protected $appModelName = 'App\Application';

  /**
   * Подключает промежуточный слой для проверки
   * авторизации и устанавливает Локаль для
   * отображения единиц измерения времени на
   * русском языке.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
    Carbon::setLocale('ru');
  }

  /**
   * Выводит главную страницу для
   * авторизированных пользователей.
   *
   * @return Illuminate\View\View
   */
  public function index() {
    return view($this->view)->with('header', 'Главная');
  }
}
