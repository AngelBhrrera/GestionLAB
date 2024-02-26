<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {

    }

    protected function validator(array $data)
    {
        switch($data['tipo']){
            
            case 'voluntariop':
            case 'voluntario':

                $rCodigo = ['required','integer','unique:users'];
                $rTelefono = ['required'];
                $rCentro = ['required','string'];
                $rCarrera = ['required', 'string', 'max:255'];
                $rSede = ['required'];
                $rArea = ['required'];
                $rhorario = ['required','string'];
                $rHoras =  ['nullable'];
               
                break;
    
            case 'practicantep':
            case 'practicante':
            case 'prestador':
            case 'prestadorp':
            case 'coordinador':

                
                $rCodigo = ['required','integer','unique:users'];
                $rTelefono = ['required'];
                $rCentro = ['required','string'];
                $rCarrera = ['required', 'string', 'max:255'];
                $rSede = ['required'];
                $rArea = ['required'];
                $rhorario = ['required','string'];
                $rHoras =  ['required'];

                break;

            case 'maestro':
            case 'alumno':
                $rCodigo = ['required','integer','unique:users'];
                $rTelefono = ['required', 'string', 'max:10'];
                $rCentro = ['required','string'];
                $rCarrera = ['required', 'string', 'max:255'];
                $rSede = ['nullable'];
                $rArea = ['nullable'];
                $rhorario = ['nullable'];
                $rHoras =  ['nullable'];
                break;

            case 'jefe area':
            case 'jefe sede':

                $rCentro = ['nullable'];
                $rTelefono = ['nullable'];
                $rCodigo = ['nullable'];
                $rCarrera = ['nullable'];
                $rSede = ['nullable'];
                $rArea = ['nullable'];
                $rhorario = ['nullable'];
                $rHoras =  ['nullable'];
                break;
        }

        return Validator::make($data, [

            //OBLIGATORIOS
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'tipo' => ['required', 'string'],
            'correo' => ['required', 'email', 'unique:users'],
            
            //VISITANTES
            'centro' => $rCentro,
            'telefono' => $rTelefono,

            'carrera' => $rCarrera,
            'codigo' =>  $rCodigo,

            //PRESTADORES Y VOLUNTARIOS

            'sede' =>  $rSede,
            'area' =>$rArea,
            'horario' => $rhorario,
            'horas' => $rHoras,

        ]);
    }

    protected function create(array $data)
    {

        $vCodigo = $data['codigo'];
        $vTelefono = $data['telefono'];
        $vCentro = $data['centro'];
        $vCarrera = $data['carrera'];

        $vSede = 0;
        $vArea = 0;
        $vhorario = "No Aplica";
        $vHoras = null;

        switch($data['tipo']) {
           
            case 'prestador':
            case 'prestadorp':
            case 'practicantep':
            case 'practicante':
            case 'coordinador':
                $vArea = $data['area'];
                $vSede = $data['sede'];
                $vhorario = $data['horario'];
                $vHoras = $data['horas'];
                break;
            case 'voluntario':
            case 'voluntariop':
                $vhorario = $data['horario'];
            case 'jefe area':
                $vArea = $data['area'];
            case 'jefe sede':     
                $vSede = $data['sede'];
                break;
        }

        User::create([
            'name' => $data['name'],
            'apellido' => $data['apellido'],
            'correo' => $data['correo'],
            'tipo' => $data['tipo'],
            'password' => Hash::make($data['password']),

            'codigo' => $vCodigo,
            'telefono' => $vTelefono,
            'centro' => $vCentro,
            'carrera' => $vCarrera,

            'sede' => $vSede,
            'area' => $vArea,
            'horario' => $vhorario,
            'horas' => $vHoras,
        ]);

        session()->flash('MADE', 'Usuario pendiente de activacion');


        return redirect('/login');
    }
}