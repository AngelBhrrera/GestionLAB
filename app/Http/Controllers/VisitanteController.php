<?php

namespace App\Http\Controllers;

use App\Models\cita_cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/*use App\Rules\MaxWordsRule;
use Illuminate\Support\Facades\DB as FacadesDB;
use DateTime;
use Symfony\Component\Console\Input\Input;
use App\Http\Controllers\MailController;*/

class VisitanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function principal()
    {
        $codigo = Auth::user()->id;
        $correo = Auth::user()->correo;
        $users = DB::table('users')->where('id',$codigo)->get();
        $cita = DB::table('cita_clientes')->where('correo',$correo)->get();
        return view('/visitante/homeV',['opcion'=>'principal_clientes', 'users'=>$users, 'cita'=>$cita, 'datos'=>['curso1', 'curso2', 'curso3'], 'datos2'=>['proyecto', 'fecha', 'status']]);
    }

    public function form(){
        return view("/visitante/registro_impresion_form");
    }

    public function visita(){
        return view('/visitante/homeV',['opcion'=>'visitas']);
    }

    public function guardarCita(Request $request)
    {
        $validator = Validator::make($request->all(),[
            // 'credencial'=>'required|image|mimes:jpg,jpeg,png|max:5120',
            // 'render'=>'required|mimes:zip|max:10240',
            // 'ArchivoSTL'=>'required|mimes:zip|max:102400',
            'enlaceDrive'=>'required',
            'correo'=>'required',
            'nombre'=> 'required',
            'telefono'=> 'required|max:10',
            'carrera' =>'required',
            'semestre' =>'required',
            'N_piezas'=> 'required',
            'proyecto'=> 'required',
            'observaciones' =>'required', //[new MaxWordsRule('hola', $request->input('Observaciones'))],
            'palabrasClave' =>'required',
            'introduccion' =>'required',
            'trabajosRelacionados' =>'required',
            'propuesta' =>'required',
            'conclusion' =>'required',
        ]);
       /* $messages = $validator->messages();

        foreach ($messages->all('<li>:message</li>') as $message)
        {
            echo $message;
        }
        */
        if($validator ->fails()){
            return redirect()->route("formulario")->withInput()->withErrors($validator->errors());
        }else{
            $datos = $request->all();
            $insert = cita_cliente::create($datos);
            return redirect()->route('formulario')->with('success', 'Mensaje de éxito');
        }
    }

    public function registro()
    {
        $carreras = DB::table('carreras')->get();
        return view('/visitante/homeV',['opcion'=>'registro_clientes','carreras' => $carreras]);
    }

    public function confirmar_cita(Request $request)
    {
        $id=$request->input('id_cita');
        $fecha=$request->input('fecha_cita');
        $modificar = DB::table('cita_clientes')->where('id_citas',$id)->update([
            'fechacita'=>$fecha,
            'status'=>"cita_pendiente"
        ]);
        return redirect()->route('cliente.home');
    }

    public function registrarVisita(Request $request)
    {

        try {
            $dir = '';
            switch (Auth::user()->tipo) {
                case 'admin':
                case 'encargado':
                case 'Superadmin':
                    $dir = 'admin.visitas';
                    $origen = Auth::user()->name . ' ' . Auth::user()->apellido;
                    $origen_id = Auth::user()->id;
                    break;
                case 'checkin':
                    $dir = 'api.checkin';
                    $origen = 'checkin';
                    break;
            };
            $codigo = $request->input('codigo');
            $usuario = DB::table('users')->where('telefono', $codigo)->where(function ($query) {
                $query->where('tipo', '=', "maestro")
                    ->orWhere('tipo', '=', "alumno");
                })
                ->select('id', 'name', 'apellido', 'correo', 'telefono', 'encargado_id')->get();
            $verificar = DB::table('visitas')->where('numero', $usuario[0]->telefono)->where('fecha', date("d/m/Y"))->where('hora_salida', null)->exists();
            if ($verificar) {
                $hor = date('H:i:s');
                $tiempo = DB::table('visitas')->select('hora_llegada')->where('numero', $usuario[0]->telefono)->where('fecha', date("d/m/Y"))->where('hora_salida', null)->get();
                $salida = DB::table('visitas')->where('numero', $usuario[0]->telefono)->where('fecha', date("d/m/Y"))->where('hora_salida', null)->update(['hora_salida' => $hor]);
                return redirect()->route($dir)->with('success', 'Visita concluida ' . $usuario[0]->name);
            } else {
                $inicio = DB::table('visitas')->insert([['numero' => $usuario[0]->telefono, 'correo' => $usuario[0]->correo, 'name' => $usuario[0]->name, 'apellido' => $usuario[0]->apellido, 'fecha' => date("d/m/Y"), 'hora_llegada' => date('H:i:s'), 'responsable' => $origen , 'responsable_id' => $origen_id]]);
                return redirect()->route($dir)->with('success', 'Visita registrada ' . $usuario[0]->name . '!');
            }
        } catch (\Throwable $th) {

            return redirect()->route($dir)->with('error', $th->getMessage());
        }
    }

}
