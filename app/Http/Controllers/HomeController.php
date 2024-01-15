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
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function register()
    {
        $carreras = DB::table('carreras')->get();
        return view('auth.register',['ruta' => 'registrar', 'nombre'=> 'registro', 'carreras' => $carreras]);
    }

    public function checkin()
    {
        return view('checkin',['nombre'=>'checkin']);
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


    public function crearImpresion(Request $request){
        $validator = Validator::make($request->all(),[
            'enlaceDrive'=>'required',
            'correo'=>'required',
            'nombre'=> 'required',
            'telefono'=> 'required|max:10',
            'N_piezas'=> 'required',
            'proyecto'=> 'required',
            'observaciones' =>[new MaxWordsRule('hola', $request->input('Observaciones'))],
            'palabrasClave' =>'required',
            'introduccion' =>'required',
            'trabajosRelacionados' =>'required',
            'propuesta' =>'required',
            'conclusion' =>'required',
        ]);
        if($validator ->fails()){
            return redirect()->route('registroImpresion')->withInput()->withErrors($validator->errors());
        }else{
           $datos = $request->all();
           $insert = cita_cliente::create($datos);
           $usuarios = DB::table('users')->get();
           return redirect()->route('formulario')->with('success', 'Mensaje de éxito');
           



            /*
            $datos = $request->all();
            $Correo = $datos["correo"];
            $usuarios = DB::table('users')->get();
            foreach($usuarios as $usuario){
                $correoUsuario = $usuario->correo;
                if($Correo == $correoUsuario){
                    $insert = cita_cliente::create($datos);
                    return redirect()->route("login")->with('success', 'se creo la impresion correctamente favor de logearte para continuar el tramite');
                }
            }
            return redirect()->route("login")->with('error', 'favor de registrarte para poder realizar la solicitud');;
        }
    }



}
