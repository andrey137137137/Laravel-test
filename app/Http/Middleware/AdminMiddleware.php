<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
{
  /**
   * Перенаправляет на главную страницу,
   * если пользователь не авторизирован
   * или не имеет прав менеджера или клиента.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $role = Auth::user()->role;
    view()->share(['userLink' => '/']);

    if ($role->edit_user) {
      return $next($request);
    }

    return redirect('/');
  }
}
