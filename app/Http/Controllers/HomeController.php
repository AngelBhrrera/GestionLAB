<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cita_cliente;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use App\Models\User;
use App\Rules\MaxWordsRule;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{

    public function __construct()
    {

    }

    public function formp(){
        return view("/visitante/public_form");
    }

  

    public function register()
    {
        $carreras = DB::table('carreras')->get();
        return view('auth.register',['ruta' => 'registrar', 'nombre'=> 'registro', 'carreras' => $carreras]);
    }

    public function checkin()
    {
        return view('checkin',['nombre'=>'checkin']);
    }

    public function public_form(Request $request){
        $validator = Validator::make($request->all(),[
            'enlaceDrive'=>'required',
            'N_piezas'=> 'required',
            'proyecto'=> 'required',
            'observaciones' =>'required', //[new MaxWordsRule('hola', $request->input('Observaciones'))],
            'palabrasClave' =>'required',
            'introduccion' =>'required',
            'trabajosRelacionados' =>'required',
            'propuesta' =>'required',
            'conclusion' =>'required',

            'name'=>"required|string|max:255",
            'apellido' =>'required|string|max:255',
            'correo'=>"required|email|unique:users",
            'telefono'=> 'required|max:10',
            'password' => 'required|string|min:3|confirmed',
            'tipo' => 'required|string',
            'centro' => 'required|string',
            'carrera' => 'required|string|max:255',
            'codigo' => 'required',
            'sede' => 'null',
            'semestre'=>'required',
            
        ]);


        if($validator->fails()){
            return redirect()->route("login")->withInput()->withErrors($validator);
        }else{
            
            $datos2 = $request->all();
            $correo = $request->input('correo');  // dato para buscar el id del nuevo usuario
            $insert2 = User::create([
                 "name" =>$datos2["name"],
                 "apellido" =>$datos2["apellido"],
                 "correo" =>$datos2["correo"],
                 "password" => Hash::make($datos2['password']),
                 "tipo" =>$datos2["tipo"],
                 "centro" =>$datos2["centro"],
                 "carrera" =>$datos2["carrera"],
                 "codigo" =>$datos2["codigo"],
                 'sede' => 0,
            ]);

            $newuser = User::where("correo", $correo)->first();

            if($newuser){
                $idUser = $newuser->id;
            }

           $datos = $request->all();
           $datos["user_id"] = $idUser;
           $insert = cita_cliente::create([
                "semestre" =>$datos["semestre"],
                "enlaceDrive" =>$datos["enlaceDrive"],
                "N_piezas" =>$datos["N_piezas"],
                "proyecto" =>$datos["proyecto"],
                "observaciones" =>$datos["observaciones"],
                "palabrasClave" =>$datos["palabrasClave"],
                "introduccion" =>$datos["introduccion"],
                "trabajosRelacionados" =>$datos["trabajosRelacionados"],
                "propuesta" =>$datos["propuesta"],
                "conclusion" =>$datos["conclusion"],
                "user_id" =>$datos["user_id"],
           ]);
           return redirect()->route('login')->with('success', 'Mensaje de éxito'); //regresar al login para inicio de sesion posterior
        }
    }
    public function update(Request $request)
    {
        $id=$request->input('id');
        $cUser = Auth::user()->id;
        if($cUser == $id){
            $input = $request->all();
            $usuario = User::findOrFail($id);
            $usuario->fill($input)->save();
        }
        return redirect("/");
    }
    public function modificaradmin(Request $request)
    {
        $id=$request->input('id');
        $cUser = Auth::user()->id;
        $user = DB::table('users')->where('id',$id)->get();
        return view('/home',['opcion'=>'modificaradmin', 'nombre' => 'modificaradmin', 'dV'=> $user, 'ruta' => 'update']);
    }

           
            /*$datos = $request->all();
            $Correo = $datos["correo"];
            $usuarios = DB::table('users')->get();
            foreach($usuarios as $usuario){
                $correoUsuario = $usuario->correo;
                if($Correo == $correoUsuario){
                    $insert = cita_cliente::create($datos);
                    return redirect()->route("login")->with('success', 'se creo la impresion correctamente favor de logearte para continuar el tramite');
                }
            }
            return redirect()->route("login")->with('error', 'favor de registrarte para poder realizar la solicitud');*/
    }
