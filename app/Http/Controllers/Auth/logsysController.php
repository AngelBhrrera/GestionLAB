<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class logsysController extends Controller
{

    public function log(){
       
        return view('auth.login');
    }

    public function loginF(Request $request){
        //VALIDACIÓN

        $credentials = [
            "correo" => $request->correo,
            "password" => $request->password,
        ];
        $remember = ($request->has('remember') ? true : false);

        if(Auth::attempt($credentials, $remember)){

            $request->session()->regenerate();

            return redirect('/');
            
        }else{
          return redirect('/login')->with('FAIL', 'Correo o contraseña incorrecta');
        }

    }

    public function redirectTo(){
      if(Auth::check()){
        $role = Auth::user()->tipo;
        switch ($role) {
            case 'admin':
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
            case 'Superadmin':
                return redirect('/admin/home');
                break;
            default:
                return redirect('/login');
        }
    }else{
        return redirect('/login');
    }
  }

    public function logoutF(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login')); 
    }

    public function show(){
        $centros = DB::select("SELECT * from centros;");
        $sede= DB::select("SELECT * FROM sede;");
        $encargado=DB::select("SELECT * FROM USERS WHERE tipo = 'admin';");
        $var = 1;
        return view('auth.register', ['encargado'=>$encargado,'sede'=>$sede, 'centros'=>$centros]);
    }

}
