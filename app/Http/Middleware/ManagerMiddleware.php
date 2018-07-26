<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ManagerMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $role = Auth::user()->role;
    view()->share(['userLink' => 'applications']);

    if (!$role->edit_user && $role->edit_application) {
      return $next($request);
    }

    return redirect('/');
  }
}
