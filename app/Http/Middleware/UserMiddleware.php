<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserMiddleware
{
  /**
   * Перенаправляет на главную страницу,
   * если пользователь не авторизирован
   * или не имеет прав администратора или менеджера.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $role = Auth::user()->role;
    view()->share(['userLink' => 'application/form']);

    if (!$role->edit_user && !$role->edit_application) {
      return $next($request);
    }

    return redirect('/');
  }
}
