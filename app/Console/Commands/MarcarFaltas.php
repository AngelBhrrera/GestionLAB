<?php

namespace App\Console\Commands;

use App\Models\faltas;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MarcarFaltas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'marcar:Faltas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando sirve para marcar las faltas de los prestadores activos que no tengan registro en el dia actual';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info("cronjob jijija");
        // $usuarios = User::where('tipo', 'prestador')->get();
        // $today1 = date('Y-m-d');
        // Log::info($today1);
        // $diafestivo = DB::table('dias_festivos')->where('fecha',$today1)->get();
        // if(count($diafestivo)  <= 0){
        //     foreach($usuarios as $usuario){
        //         Log::info($usuario->horario);
        //         if($usuario->horario != 'sabados' && (date('D') != 'Sat') && date('D') != 'Sun' ){
        //             $today = date('d/m/Y');
        //             $revisar = DB::table('registros_checkin')->where('idusuario', $usuario->id)->where('fecha', $today)->get();
        //             if(count($revisar) <= 0){
        //             $falta = new faltas();
        //             $falta->id_usuario = $usuario->id;
        //             $falta->fecha = $today;
        //             $falta->nombre = $usuario->name;
        //             $falta->apellido = $usuario->apellido;
        //             $falta->correo = $usuario->correo;
        //             $falta->save();

        //             }


        //         }
        //         elseif($usuario->horario == 'sabados' && (date('D') == 'Sat') ){
        //             $today = date('d/m/Y');
        //             $revisar = DB::table('registros_checkin')->where('idusuario', $usuario->id)->where('fecha', $today)->get();
        //             if(count($revisar) <= 0){
        //             $falta = new faltas();
        //             $falta->id_usuario = $usuario->id;
        //             $falta->fecha = $today;
        //             $falta->nombre = $usuario->name;
        //             $falta->apellido = $usuario->apellido;
        //             $falta->correo = $usuario->correo;
        //             $falta->save();

        //             }
        //         }
        //     }
        // }
        $usuarios = User::where('tipo', 'prestador')->get();
        $today = date('Y-m-d');
        $today1 = date('d/m/Y');
        // Log::info($today1);
        $diafestivo = DB::table('dias_festivos')->where('fecha',$today)->get();
        if(count($diafestivo)  <= 0){
            foreach($usuarios as $usuario){
                $horario =  DB::table('horarios')->where('descripcion',$usuario->horario)->first();
                // Log::info(json_encode($horario));
                if($horario){
                    if($horario->lunes == 1 && date('D') == 'Mon'){
                        $revisar = DB::table('registros_checkin')->where('idusuario', $usuario->id)->where('fecha', $today1)->get();
                        if(count($revisar) <= 0){
                            $falta = new faltas();
                            $falta->id_usuario = $usuario->id;
                            $falta->fecha = $today;
                            $falta->nombre = $usuario->name;
                            $falta->apellido = $usuario->apellido;
                            $falta->correo = $usuario->correo;
                            $falta->save();
                        }
                    }
                    if($horario->martes == 1 && date('D') == 'Tue'){
                        $revisar = DB::table('registros_checkin')->where('idusuario', $usuario->id)->where('fecha', $today1)->get();
                        if(count($revisar) <= 0){
                            $falta = new faltas();
                            $falta->id_usuario = $usuario->id;
                            $falta->fecha = $today;
                            $falta->nombre = $usuario->name;
                            $falta->apellido = $usuario->apellido;
                            $falta->correo = $usuario->correo;
                            $falta->save();
                        }
                    }
                    if($horario->miercoles == 1 && date('D') == 'Wed'){
                        $revisar = DB::table('registros_checkin')->where('idusuario', $usuario->id)->where('fecha', $today1)->get();
                        if(count($revisar) <= 0){
                            $falta = new faltas();
                            $falta->id_usuario = $usuario->id;
                            $falta->fecha = $today;
                            $falta->nombre = $usuario->name;
                            $falta->apellido = $usuario->apellido;
                            $falta->correo = $usuario->correo;
                            $falta->save();
                        }
                    }
                    if($horario->jueves == 1 && date('D') == 'Thu'){
                        $revisar = DB::table('registros_checkin')->where('idusuario', $usuario->id)->where('fecha', $today1)->get();
                        if(count($revisar) <= 0){
                            $falta = new faltas();
                            $falta->id_usuario = $usuario->id;
                            $falta->fecha = $today;
                            $falta->nombre = $usuario->name;
                            $falta->apellido = $usuario->apellido;
                            $falta->correo = $usuario->correo;
                            $falta->save();
                        }
                    }
                    if($horario->viernes == 1 && date('D') == 'Fri'){
                        $revisar = DB::table('registros_checkin')->where('idusuario', $usuario->id)->where('fecha', $today1)->get();
                        if(count($revisar) <= 0){
                            $falta = new faltas();
                            $falta->id_usuario = $usuario->id;
                            $falta->fecha = $today;
                            $falta->nombre = $usuario->name;
                            $falta->apellido = $usuario->apellido;
                            $falta->correo = $usuario->correo;
                            $falta->save();
                        }
                    }
                    if($horario->sabado == 1 && date('D') == 'Sat'){
                        $revisar = DB::table('registros_checkin')->where('idusuario', $usuario->id)->where('fecha', $today1)->get();
                        if(count($revisar) <= 0){
                            $falta = new faltas();
                            $falta->id_usuario = $usuario->id;
                            $falta->fecha = $today;
                            $falta->nombre = $usuario->name;
                            $falta->apellido = $usuario->apellido;
                            $falta->correo = $usuario->correo;
                            $falta->save();
                        }
                    }
                    if($horario->domingo == 1 && date('D') == 'Sun'){
                        $revisar = DB::table('registros_checkin')->where('idusuario', $usuario->id)->where('fecha', $today1)->get();
                        if(count($revisar) <= 0){
                            $falta = new faltas();
                            $falta->id_usuario = $usuario->id;
                            $falta->fecha = $today;
                            $falta->nombre = $usuario->name;
                            $falta->apellido = $usuario->apellido;
                            $falta->correo = $usuario->correo;
                            $falta->save();
                        }
                    }
                }
                // Log::info(date('D'));
                // Log::info(date('D',strtotime("+1 day")));
                // Log::info(date('D',strtotime("+2 day")));
                // Log::info(date('D',strtotime("+3 day")));
                // Log::info(date('D',strtotime("+4 day")));
                // Log::info(date('D',strtotime("+5 day")));
                // Log::info(date('D',strtotime("+6 day")));
                // Log::info(date('D',strtotime("+7 day")));
            }
        }
    }
}
