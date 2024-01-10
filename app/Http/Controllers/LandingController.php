<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index(){
        $matutino =  DB::select("SELECT CONCAT(name, ' ', apellido) AS Nombre , correo, horario from users WHERE fecha_salida is NULL AND sede = 1 AND horario = 'Matutino' AND (tipo = 'admin' OR tipo = 'encargado')");  
        $mediodia =  DB::select("SELECT CONCAT(name, ' ', apellido) AS Nombre , correo, horario from users WHERE fecha_salida is NULL AND sede = 1 AND horario = 'Mediodia' AND (tipo = 'admin' OR tipo = 'encargado')");  
        $vespertino = DB::select("SELECT CONCAT(name, ' ', apellido) AS Nombre , correo, horario from users WHERE fecha_salida is NULL AND sede = 1 AND horario = 'Vespertino' AND (tipo = 'admin' OR tipo = 'encargado')");  
        $sabatino =  DB::select("SELECT CONCAT(name, ' ', apellido) AS Nombre , correo, horario from users WHERE fecha_salida is NULL AND sede = 1 AND horario = 'Sabatino' AND (tipo = 'admin' OR tipo = 'encargado')");  
    
        $leaderBoard= DB::select("SELECT * from full_leaderboard limit 10");  
    
        return view(
            'landingPage',
            [
                'leaderBoard'=> $leaderBoard, 'matutino'=>$matutino, 'mediodia'=>$mediodia, 'vespertino'=>$vespertino, 'sabatino'=>$sabatino
            ]
        );
    }

    public function devTeam(){
        return view('devTeam');
    }
    
    public function articulos(){
        return view('landingArticulos');
    }
}
