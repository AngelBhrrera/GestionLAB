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
           
            case 'jefe area':
            case 'jefe sede':
            case 'Superadmin':
                return redirect('/admin/home');
                break;
            case 'coordinador':
            case 'prestador':
            case 'voluntario':
            case 'practicante':
                return redirect('/prestador/home');
                break;
            case 'maestro':
            case 'alumno':
            case 'externo':
                return redirect('/cliente/home');
                break;
            case 'checkin':
                return redirect('/check-in');
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
        $sede = DB::select("SELECT * FROM sedes;");

        return view('auth.register', ['sede'=>$sede]);
    }

    public function filtroSede($id){

        $area = DB::table('filtrosedes')
            ->where('id_sede', $id)
            ->get();

        return response()->json($area);
    }

    public function filtroArea($id){

        $turno = DB::table('areas')
        ->where('id', $id)
        ->get();
        return response()->json($turno);
    }

    public function filtroTurno($t, $area){

        $users = DB::table('users')
            ->select('id', 'name', 'apellido')
            ->where('area', $area)
            ->where(function ($query) use ($t) {
                $query->where('horario', $t)
                    ->orWhere('horario', 'No Aplica');
            }) 
            ->where(function ($query) {
                $query->where('tipo', 'coordinador')
                    ->orWhere('tipo', 'jefe area');
            })
            ->get();

        return response()->json($users);
    }

}
