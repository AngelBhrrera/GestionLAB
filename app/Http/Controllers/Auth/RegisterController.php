<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
            case 'admin':
                $rHoras =  ['nullable'];
                $rCentro = ['nullable'];
                $rCodigo = ['nullable'];
                $rTelefono = ['nullable'];
                break;
            case 'prestadorp':
                $rHoras =  ['required'];
                $rCentro = ['required','string'];
                $rTelefono = ['required'];
                $rCodigo = ['required','string','unique:users'];
                break;
            case 'prestador':
                $rHoras =  ['required'];
                $rCentro = ['required','string'];
                $rTelefono = ['required'];
                $rCodigo = ['required','string','unique:users'];
                break;
                
            // case 'clientes':
            //     switch($data['tipo_cliente']){
            //         case 'Alumno':
            //         case 'Maestro':
            //             $rHoras =  ['nullable'];
            //             $rCentro = ['required','string'];
            //             $rTelefono = ['required','string'];
            //             $rCodigo = ['required','string','unique:users'];
            //             break;
            //         case 'Otro':
            //             $rHoras =  ['nullable'];
            //             $rCentro = ['nullable'];
            //             $rTelefono = ['nullable'];
            //             $rCodigo = ['nullable'];
                        
            //     }
            //     break;
            case 'Alumno':
            case 'Maestro':
                $rHoras =  ['nullable'];
                $rCentro = ['required','string'];
                $rTelefono = ['required','string'];
                $rCodigo = ['required','string','unique:users'];
                break;
            case 'Otro':
                $rHoras =  ['nullable'];
                $rCentro = ['nullable'];
                $rTelefono = ['nullable'];
                $rCodigo = ['nullable'];
        }
        

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'codigo' => $rCodigo,
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'tipo' => ['required', 'string'],
            'correo' => ['required', 'email', 'unique:users'],
            'horas' => $rHoras,
            'centro' => $rCentro,
            'carrera' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:10'],
            // 'telefono' => $rTelefono,
            'tipo_cliente' => ['nullable']

        ]);
    }

    protected function create(array $data)
    {
        switch($data['tipo']){
            case 'admin':
                $vHoras =  null;
                $vCentro =  null;
                $vCarrera = null;
                $vTelefono =  null;
                $vCodigo = null;
                $vTipo_cliente = null;
                break;
            case 'prestador':
                $vHoras =  $data['horas'];
                $vCentro =  $data['centro'];
                $vCarrera = $data['carrera'];
                $vTelefono =  $data['telefono'];
                $vCodigo = $data['codigo'];
                $vTipo_cliente = null;
                break;
            case 'prestadorp':
                $vHoras =  $data['horas'];
                $vCentro =  $data['centro'];
                $vCarrera = $data['carrera'];
                $vTelefono =  $data['telefono'];
                $vCodigo = $data['codigo'];
                $vTipo_cliente = null;
                break;
            case 'clientes':
                switch($data['tipo_cliente']){
                    case 'Alumno':
                    case 'Maestro':
                        $vHoras =  null;
                        $vCarrera = $data['carrera'];
                        $vCodigo = $data['codigo'];
                        $vCentro =  $data['centro'];
                        $vTelefono =  $data['telefono'];
                        $vTipo_cliente = $data['tipo_cliente'];
                        break;
                    case 'Otro':
                        $vHoras =  null;
                        $vCarrera = null;
                        $vCodigo = null;
                        $vCentro =  $data['centro'];
                        $vTelefono =  $data['telefono'];
                        $vTipo_cliente = $data['tipo_cliente'];
                }
                break;
        }

        // $centro = isset($data['centro']) ? $data['centro'] : null;

        return User::create([
            'name' => $data['name'],
            'apellido' => $data['apellido'],
            'codigo' => $vCodigo,
            'password' => Hash::make($data['password']),
            'tipo' => $data['tipo'],
            'correo' => $data['correo'],
            'horas' => $vHoras,
            'centro' => $vCentro,
            'carrera' => $data['carrera'],
            'telefono' => $vTelefono,
            'tipo_cliente' => $vTipo_cliente,
            'encargado_id' => $data['encargado_id']
        ]);
    }
}
