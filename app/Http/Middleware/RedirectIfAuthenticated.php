<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {
        if (Auth::guard($guard)->check()) {
          $role = Auth::user()->tipo;

          switch ($role) {
            case 'admin':
               return redirect('/admin/home');
               break;
            case 'Superadmin':
                return redirect('/admin/home');
                break;
            case 'prestador':
               return redirect('/prestador/home');
               break;
            case 'clientes':
                return redirect('/home');
                break;
            case 'checkin':
                return redirect('/check-in');
                break;

          }
        }
        return $next($request);
      }
}
