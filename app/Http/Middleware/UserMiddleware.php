<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserMiddleware
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

    if (!$role->edit_user && !$role->edit_application) {
      return $next($request);
    }

    return redirect('/');
  }
}