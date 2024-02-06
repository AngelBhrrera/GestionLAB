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

                $rCodigo = ['required','string','unique:users'];
                $rTelefono = ['required'];
                $rCentro = ['required','string'];
                $rCarrera = ['required', 'string', 'max:255'];
                $rSede = ['required'];
                $rArea = ['required'];
                $rhorario = ['required','string'];
                $rHoras =  ['nullable'];
                $rEncargado = ['required'];
               
                break;
    
            case 'practicantep':
            case 'practicante':
            case 'prestador':
            case 'prestadorp':
                
                $rCodigo = ['required','string','unique:users'];
                $rTelefono = ['required'];
                $rCentro = ['required','string'];
                $rCarrera = ['required', 'string', 'max:255'];
                $rSede = ['required'];
                $rArea = ['required'];
                $rhorario = ['required','string'];
                $rHoras =  ['required'];
                $rEncargado = ['required'];

                break;

            case 'maestro':
            case 'alumno':
                $rCodigo = ['required','string','unique:users'];
                $rTelefono = ['required', 'string', 'max:10'];
                $rCentro = ['required','string'];
                $rCarrera = ['required', 'string', 'max:255'];
                $rSede = ['nullable'];
                $rArea = ['nullable'];
                $rhorario = ['nullable'];
                $rHoras =  ['nullable'];
                $rEncargado = ['nullable'];
                break;

            case 'admin':

                $rCentro = ['nullable'];
                $rTelefono = ['nullable'];
                $rCodigo = ['nullable'];
                $rCarrera = ['nullable'];
                $rSede = ['nullable'];
                $rArea = ['nullable'];
                $rhorario = ['nullable'];
                $rHoras =  ['nullable'];
                $rEncargado = ['nullable'];
                break;

            case 'encargado':
                $rCentro = ['nullable'];
                $rTelefono = ['nullable'];
                $rCodigo = ['nullable'];
                $rCarrera = ['nullable'];
                $rSede = ['nullable'];
                $rArea = ['nullable'];
                $rhorario = ['nullable'];
                $rHoras =  ['nullable'];
                $rEncargado = ['nullable'];
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
            'encargado_id' =>  ['nullable'],

        ]);
    }

    protected function create(array $data)
    {
        $vCodigo = $data['codigo'];
        $vTelefono = $data['telefono'];
        $vCentro = $data['centro'];
        $vCarrera = $data['carrera'];

        $vSede = 0;
        $vArea = null;
        $vhorario = null;
        $vHoras = null;
        $vEncargado = null;

        switch($data['tipo']) {
           
            
            case 'prestador':
            case 'prestadorp':
            case 'practicantep':
            case 'practicante':
                $vArea = $data['area'];
                $vEncargado = $data['id_encargado'];
            case 'encargado':
                $vSede = $data['sede'];
                $vhorario = $data['horario'];
                $vHoras = $data['horas'];
                break;
            case 'voluntario':
            case 'voluntariop':
                $vSede = $data['sede'];
                $vArea = $data['area'];
                $vhorario = $data['horario'];
                $vEncargado = $data['id_encargado'];
                break;
            case 'admin':
                $vArea = $data['area'];
            case 'admin_sede':     
                $vSede = $data['sede'];
                break;
        }

        return User::create([
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
            'encargado_id' => $vEncargado,
            
        ]);
    }
}