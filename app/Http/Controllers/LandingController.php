<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LandingController extends Controller
{
    public function index(){

        $resp = DB::table('users')
            ->select(DB::raw("CONCAT(name, ' ', apellido) AS Nombre"), 'correo', 'horario')
            ->whereNull('fecha_salida')
            ->where('area', 1)
            ->where('horario', 'Matutino')
            ->where(function($query) {
                $query->where('tipo', 'jefe area')
                    ->orWhere('tipo', 'coordinador');
            });

        $matutino = $resp->where('horario', 'Matutino')->get();
        $mediodia =   $resp->where('horario', 'Mediodia')->get();
        $vespertino =  $resp->where('horario', 'Vespertino')->get();
        $sabatino =   $resp->where('horario', 'Sabatino')->get();

        $leaderBoard = $this->consultarLeaderboard('lb_at',1,'area',10);
        $leaderBoardW = $this->consultarLeaderboard('lb_w',1,'area',10);
        $leaderBoardM = $this->consultarLeaderboard('lb_m',1,'area',10);
    
        return view(
            'landingPage', compact('leaderBoard','leaderBoardW','leaderBoardM','matutino','vespertino','mediodia','sabatino')
        );
    }

    private function consultarLeaderboard($tabla, $filtro,$zona,$limit)
    {
        return DB::table($tabla)
            ->select('solo_prestadores.codigo', 'solo_prestadores.semanas_actividad', "$tabla.total_exp", 'solo_prestadores.ruta', 'solo_prestadores.max_nivel', 'solo_prestadores.imagen_perfil')
            ->selectRaw('ROW_NUMBER() OVER (ORDER BY '.$tabla.'.total_exp DESC) AS Posicion')
            ->selectRaw('CONCAT(solo_prestadores.name, " ", solo_prestadores.apellido) AS Inventor')
            ->join('solo_prestadores', 'solo_prestadores.id', '=', "$tabla.id_prestador")
            ->where('solo_prestadores.id_'.$zona.'', $filtro)
            ->orderByDesc("$tabla.total_exp")
            ->limit($limit)
            ->get();
    }

    public function devTeam(){
        return view('devTeam');
    }
    
    public function articulos(){
        return view('landingArticulos');
    }
}
