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

        $customMessages = [
            'required' => 'El campo :attribute es obligatorio.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'unique' => 'El valor ingresado en el campo :attribute ya existe en la base de datos.',
            'max:255' => 'El campo :attribute no debe sobrepasar 255 caracteres.',
            'string' => 'El campo :attribute debe ser una cadena de texto.',
            'max:10' => 'El campo :attribute no debe sobrepasar 10 caracteres.',
            'min:3' => 'El campo :attribute debe tener al menos tres caracteres.',
            'confirmed' => 'El campo :attribute debe ser igual en ambos.'
        ];
    
        $customAttributes = [
            'name' => 'Nombre',
            'apellido' => 'Apellido',
            'password' => 'Contraseña',
            'tipo' => 'Tipo',
            'correo' => 'Correo electrónico',
            'centro' => 'Centro',
            'telefono' => 'Teléfono',
            'carrera' => 'Carrera',
            'codigo' => 'Código',
            'sede' => 'Sede',
            'area' => 'Área',
            'horario' => 'Horario',
            'horas' => 'Horas'
        ];

        $validator = Validator::make($data, [

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

        ], $customMessages, $customAttributes);

        if ($validator->fails()) {
            session()->flash('alert-type', 'error');
            session()->flash('alert-message', 'Error en la validación: ' . $validator->errors()->first());
        }
    
        return $validator;
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

        try {
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
            session()->flash('primary-type', 'alert');
            return redirect('/login')->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el usuario: ' . $e->getMessage())->withInput();
        }
    }
}