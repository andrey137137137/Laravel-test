<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
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
    view()->share(['userLink' => '/']);

    if ($role->edit_user) {
      return $next($request);
    }

    return redirect('/');
  }
}
