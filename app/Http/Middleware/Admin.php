<?php

namespace App\Http\Middleware;

use Closure;  
use Illuminate\Support\Facades\Auth;


class Admin  
{
  public function handle($request, Closure $next, $guard = null )
  {
    if (Auth::guard('web_usuario')->guest()) {
      if ($request->ajax()) {
        return response('Unauthorized.', 401);
      } else {
        return redirect()->guest('login');
      }
    } else if (!Auth::guard('web_usuario')->user()->administrador) {
      return redirect()->to('/home')->withError('Permissão Negada!');
    }

    return $next($request);
  }
}