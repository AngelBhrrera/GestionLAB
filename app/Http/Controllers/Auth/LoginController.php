<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{

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

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
