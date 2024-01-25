<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function redirectTo() {
        $role = Auth::user()->tipo;
        switch ($role) {
          case 'admin':
            return '/admin/home';
            break;
          case 'voluntario':
          case 'practicante':
          case 'encargado':
          case 'prestador':
            return '/prestador/home';
            break;
          case 'clientes':
            return '/home';
            break;
          case 'checkin':
            return '/check-in';
            break;
          case 'Superadmin':
            return '/admin/home';
            break;
          default:
            return '/';
            break;

        }
      }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
