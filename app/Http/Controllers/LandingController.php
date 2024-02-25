<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index(){
        $matutino =  DB::select("SELECT CONCAT(name, ' ', apellido) AS Nombre , correo, horario from users WHERE fecha_salida is NULL AND sede = 1 AND horario = 'Matutino' AND (tipo = 'jefe area' OR tipo = 'coordinador')");  
        $mediodia =  DB::select("SELECT CONCAT(name, ' ', apellido) AS Nombre , correo, horario from users WHERE fecha_salida is NULL AND sede = 1 AND horario = 'Mediodia' AND (tipo = 'jefe area' OR tipo = 'coordinador')");  
        $vespertino = DB::select("SELECT CONCAT(name, ' ', apellido) AS Nombre , correo, horario from users WHERE fecha_salida is NULL AND sede = 1 AND horario = 'Vespertino' AND (tipo = 'jefe area' OR tipo = 'coordinador')");  
        $sabatino =  DB::select("SELECT CONCAT(name, ' ', apellido) AS Nombre , correo, horario from users WHERE fecha_salida is NULL AND sede = 1 AND horario = 'Sabatino' AND (tipo = 'jefe area' OR tipo = 'coordinador')");  
    
        $leaderBoard= DB::select("SELECT * from full_leaderboard limit 10");  
        $leaderBoardW= DB::select("SELECT * from full_leaderboard_w limit 10");  
        $leaderBoardM= DB::select("SELECT * from full_leaderboard_m limit 10");  
    
        return view(
            'landingPage', compact('leaderBoard','leaderBoardW','leaderBoardM','matutino','vespertino','mediodia','sabatino')
        );
    }

    public function devTeam(){
        return view('devTeam');
    }
    
    public function articulos(){
        return view('landingArticulos');
    }
}
