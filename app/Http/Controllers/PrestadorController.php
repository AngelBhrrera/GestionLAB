<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Illuminate\Support\Facades\Log;
use App\Models\User;


class PrestadorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $code = Auth::user()->codigo;
        if(request()->ajax()) {
            $data = DB::table('registros_checkin')
            ->select('SELECT `fecha`, `hora_entrada`, `hora_salida`, `tiempo`, `horas`, `estado` FROM `registros_checkin` WHERE `codigo` =' + $code )
            ->get();

            return datatables()->of($data)
        //->addColumn('action', 'employee-action')
          //  ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('homeP');
    }

    public function home(){
        
        $id = Auth::user()->id;
        $experiencia = Auth::user()->experiencia;
        $horasAutorizadas = DB::table('registros_checkin')->where('idusuario', $id)->where('estado', 'autorizado')->sum('horas');
        $horasPendientes = DB::table('registros_checkin')->where('idusuario', $id)->where('estado', 'pendiente')->sum('horas');
        $horasTotales = DB::table('users')->where('id', $id)->select('horas')->get();
        $horasRestantes = $horasTotales[0]->horas - $horasAutorizadas;
        $leaderBoard= DB::select("SELECT * from full_leaderboard limit 10");
        $posicionUsuario = DB::select("SELECT x.experiencia, x.id, x.position, CONCAT(x.name, ' ', x.apellido) AS 'Nombre' FROM (SELECT users.id, users.name, users.apellido, @rownum := @rownum + 1 AS position, 
        users.experiencia FROM users JOIN (SELECT @rownum := 0) r ORDER BY users.experiencia DESC) x WHERE x.id = $id;");
        $usuarioMedalla = DB::table('niveles')
        ->join('medallas', 'niveles.nivel', '=', 'medallas.nivel')
        ->select('niveles.nivel', 'medallas.ruta', 'medallas.descripcion')
        ->where('niveles.experiencia_acumulada', '<=', $experiencia?? 1) // Si la experiencia es null, establece la experiencia acumulada en 0.
        ->orderByDesc('niveles.experiencia_acumulada')
        ->first();
        
        
        return view(
            'prestador/newHomeP',
            [
                'horasAutorizadas' => $horasAutorizadas,
                'horasPendientes' => $horasPendientes,
                'horasTotales'=> $horasTotales[0]->horas,
                'horasRestantes' => $horasRestantes,
                'leaderBoard'=> $leaderBoard,
                'posicionUsuario'=> $posicionUsuario,
                'usuarioMedalla'=>$usuarioMedalla,

            ]
        );
    }

    public function create_imps()
    {
        $impresoras = DB::table('impresoras')
            ->select('*')
            ->where('estado', 'Activo')
            ->get();
        $proy = DB::table('proyectos')->select('*')->get();

        return view('prestador/registro_impresion',
            ['imps' => $impresoras,
            'proys' => $proy
        ]);
    }

    public function register_imps(Request $request)
    {
        $origin = Auth::user()->id;
        $name = $request->input('name');
        $proy = $request->input('proyect');
        $model = $request->input('model');
        $color = $request->input('color');
        $pieces = $request->input('pieces');
        $w = $request->input('weight');

        $horas = $request->input('horas');
        $horasFormateadas = str_pad($horas, 2, '0', STR_PAD_LEFT);
        $minutos = $request->input('minutos');
        $minsFormateados = str_pad($minutos, 2, '0', STR_PAD_LEFT);
        $tiempo = $horasFormateadas . 'h' . $minsFormateados . 'm';
        
        $make_imp = DB::table('seguimiento_impresiones')
        ->insert([['id_Prestador' => $origin, 'id_Impresora' => $name, 
        'id_Proyecto' => $proy, 'nombre_modelo_stl' => $model, 
         'color' => $color, 'piezas' => $pieces,
         'peso' => $w, 'tiempo_impresion' => $tiempo]]);

        $actual = DB::table('seguimiento_impresiones')
            ->where('id_Impresora', $name)
            ->orderByDesc('fecha')
            ->limit(1)
            ->value('fecha');

        DB::table('impresoras')
            ->where('id', $name)
            ->update(['ultimo_uso' => $actual]);

        return redirect()->route('show_imps');
    }

    public function show_imps()
    {
        $data = DB::table('ver_impresiones')
        ->select('impresora', 'proyecto',  'fecha', 'nombre_modelo_stl', 'tiempo_impresion', 'color', 'piezas', 'estado', 'peso', 'observaciones')
        ->where('id_Prestador', Auth::user()->id)
        ->orderByDesc('fecha')
        ->get();

        return view('prestador/mostrar_mis_impresiones', ['impresiones' => json_encode($data)]);

    }

    
    public function horario()
    {
        $id = Auth::user()->id;
        
        $turno = Auth::user()->horario;

        $asistencias = DB::table('registros_checkin')
            ->select('fecha')
            ->where('idusuario', $id)
            ->orderBy('fecha_actual', 'desc')
            ->get();

        $diasAsistenciaMesActual = [];

        $mesActual = date('m'); 

        foreach ($asistencias as $asistencia) {

            $mesAsistencia = (int)substr($asistencia->fecha, 0, 1); 
            $diaAsistencia = (int)substr($asistencia->fecha, 3, 4); 

            if ($mesAsistencia == $mesActual) {
                $diasAsistenciaMesActual[] = $diaAsistencia;
            }
        }
        return view('/prestador/horario_prestador', [
                'asistencias' => $diasAsistenciaMesActual,
                'turn' => $turno
        ]);
    }

    public function horas()
    {
        $id = Auth::user()->id;

        $asistencias = DB::table('registros_checkin')
        ->where('idusuario', $id)
        ->orderBy('fecha_actual', 'desc')
        ->get();

        return view('prestador/homeP', ['datos' => json_encode($asistencias)]);

    }

    public function marcar(Request $request)
    {
        try {
            $dir = '';
            switch (Auth::user()->tipo) {
                case 'admin':
                case 'Superadmin':
                case 'encargado':
                    $dir = 'admin.checkin';
                    $origen = Auth::user()->name . ' ' . Auth::user()->apellido;
                    break;
                case 'checkin':
                    $dir = 'api.checkin';
                    $origen = 'checkin';
                    break;
            };

            $codigo = $request->input('codigo');
            $usuario = DB::table('users')->where('codigo', $codigo)->where(function ($query) {
                $query->where('tipo', '=', "prestador")
                    ->orWhere('tipo', '=', "encargado")
                    ->orWhere('tipo', '=', "voluntario")
                    ->orWhere('tipo', '=', "practicante");
            })
                ->select('name', 'id', 'apellido', 'tipo', 'encargado_id')->get();
            $verificar = DB::table('registros_checkin')
            ->where('idusuario', $usuario[0]->id)
            ->where('fecha', date("d/m/Y"))
            ->where('hora_salida', null)->exists();
            if ($verificar) {

                $hor = date('H:i:s');

                $tiempo = DB::table('registros_checkin')
                ->select('hora_entrada')
                ->where('idusuario', $usuario[0]->id)
                ->where('fecha', date("d/m/Y"))
                ->where('hora_salida', null)->get();

                $tiempoCompleto = $this->diferencia($tiempo[0]->hora_entrada, $hor);

                $salida = DB::table('registros_checkin')
                ->where('idusuario', $usuario[0]->id)
                ->where('fecha', date("d/m/Y"))
                ->where('hora_salida', null)
                ->update(['hora_salida' => $hor, 'tiempo' => $tiempoCompleto, 'horas' => $this->horasC($tiempoCompleto)]);

                return redirect()->route($dir)->with('success', 'Adios ' . $usuario[0]->name);
            } else {

                $inicio = DB::table('registros_checkin')
                ->insert([['origen' => $origen, 'idusuario' => $usuario[0]->id, 'codigo' => $codigo, 'nombre' => $usuario[0]->name, 
                'apellido' => $usuario[0]->apellido, 'fecha' => date("d/m/Y"), 'hora_entrada' => date('H:i:s'), 'horas' => 0, 'tipo' => $usuario[0]->tipo, 
                'encargado_id' => $usuario[0]->encargado_id]]);

                return redirect()->route($dir)
                ->with('success', 'Bienvenido ' . $usuario[0]->name . '!');
            }
        } catch (\Throwable $th) {

            return redirect()->route($dir)->with('error', $th->getMessage());
        }
    }

    public function asignarfirmas(Request $request)
    {
        $id = $request->input('id');
        $horas = $request->input('horas');
        $nota = $request->input('nota');
        $pdf = $request->input('pdf');
        $usuario = DB::table('users')->where('id', $id)->where('tipo', 'prestador')->select('name', 'id', 'apellido', 'codigo')->get();
        $inicio = DB::table('registros_checkin')->insert([['origen' => 'Superadmin', 'idusuario' => $usuario[0]->id, 'codigo' => $usuario[0]->codigo, 'nombre' => $usuario[0]->name, 'apellido' => $usuario[0]->apellido, 'fecha' => date("d/m/Y"), 'hora_entrada' => 'no aplica', 'hora_salida' => 'no aplica', 'horas' => $horas, 'nota' => $nota, 'pdf' => $pdf, 'tiempo' => 'no aplica', 'estado' => 'autorizado', 'responsable' => $request->input('responsable')]]);
        return redirect()->route('admin.prestadores');
    }

    public function guardarNota(Request $request)
    {
        $id = $request->input('id');
        $nota = $request->input('nota');
        // GUARDAR IMAGEN
        $imagen = $request->file('imagen');

        if ($imagen) {
            $rutaGuardarImg = public_path('/imagen/notas');
            $imagenName = date("d-m-Y-H-i-s") . "_" . $request->input('id');
            $imagenName = $imagenName . ".jpg";
            $imagen->move($rutaGuardarImg, $imagenName);
            $srcimage = "$imagenName";
        } else {
            $srcimage = null;
        }


        // FIN GUARDAR IMAGEN

        $modificar = DB::table('registros_checkin')->where('id', $id)->update(['nota' => $nota, 'srcimagen' => $srcimage]);
        return redirect('/admin/firmas');
    }

    function diferencia($hora, $hora2)
    {
        $time1 = new DateTime($hora);
        $time2 = new DateTime($hora2);
        $interval = $time1->diff($time2);
        return $interval->format('%H:%I:%S');
    }

    function horasC($time)
    {
        $horas = new DateTime($time);
        $tiempo = $horas->format('H.i');
        if (fmod($tiempo, 1) > 0.30) {
            $tiempo = $tiempo + 1;
        }
        return intval($tiempo);
    }

    public function proyectos()
    {
        $id = Auth::user()->id;
        $actividad_prestador = DB::table('actividad_tabla')->where('id_prestador', $id)->where('status', 'en proceso')->get();
        $Impresiones_prestador = DB::table('impresionesasignados')->where('id_prestador', $id)->where('status_impresion', 'en proceso')->get();

        return view(
            '/prestador/proyectos_tabla_prestador',
            [
                'actividades' => $actividad_prestador,
                'impresiones' => $Impresiones_prestador,
            ]
        );
    }

    public function proyectos_prendientes()
    {
        $id = Auth::user()->id;
        $actividad_prestador = DB::table('actividad_tabla')->where('id_prestador', $id)->get();
        $Impresiones_prestador = DB::table('impresionesasignados')->where('id_prestador', $id)->where('status_impresion', 'en proceso')->get();

        return view(
            '/prestador/proyectos_pendientes_prestador',
            [
                'actividades' => $actividad_prestador,
                'impresiones' => $Impresiones_prestador,
            ]
        );
    }


    public function completar_impresion(Request $request)
    {
        $id = $request->input('id');

        $modificar = DB::table('proyectos_prestadores')->where('id_proyecto', $id)->update(['status' => "completado"]);
        $modificar2 = DB::table('cita_clientes')->where('id_citas', $id)->update(['status' => "impresion_terminar"]);
        //return redirect('/proyectostabla');

        $id2 = Auth::user()->id;
        $actividad_prestador = DB::table('actividad_tabla')->where('id_prestador', $id2)->where('status', 'en proceso')->get();
        $Impresiones_prestador = DB::table('impresionesasignados')->where('id_prestador', $id2)->where('status_impresion', 'en proceso')->get();

        return view(
            '/prestador/proyectos_tabla_prestador',
            [
                'actividades' => $actividad_prestador,
                'impresiones' => $Impresiones_prestador,
            ]
        );
    }

    public function prestadoresProyectosCompletados()
    {
        $columns = array(["data" => "Nombre_Proyecto"], ["data" => "nombre_cliente"], ["data" => "fecha"], ["data" => "status_impresion"]);
        $id = Auth::user()->id;


        return view(
            '/prestador/proyectos_pendientes_prestador',
            [
                'datos' => ["Proyecto", "Cliente", "Fecha", "Status"],
                'titulo' => 'Tabla Proyectos-Prestadores',
                'ajaxroute' => 'ss.ssImpresionesTerminadas',
                "columnas" => json_encode($columns),
            ]
        );
    }

    public function completar_actividad(Request $request)
    {
        $ldate = date('d/m/Y');
        $id = $request->input('id');
        // echo "<script> alert(JSON.stringify($id)); </script>";
        $modificar = DB::table('c_actividad')->where('id_actividad', $id)->update(['status' => "completado", 'fecha_realizada' => $ldate]);

        return redirect('/prestador/proyectos_pendientes_prestador');
    }

    public function horario_guardar(Request $request)
    {
        $horario = $request->input('horario');
        $id = Auth::user()->id;


        // echo "<script> alert(JSON.stringify($id)); </script>";
        $modificar = DB::table('users')->where('id', $id)->update(['horario' => $horario]);

        return redirect('/prestador/proyectos_pendientes_prestador');
    }


    public function Pactividadterminada()
    {
        $columns = array(
            ["data" => "llave_actividad", "visible" => false],
            ["data" => "nombre_act"],
            ["data" => "tipo_act"],
            ["data" => "descripcion", "visible" => false, "sortable" => false],
            ["data" => "objetivo", "visible" => false, "sortable" => false],
            ["data" => "fecha"],
            ["data" => "status"],
        );
        $id = Auth::user()->id;

        return view(
            '/prestador/P_actividades',
            [
                'datos' => ['id_actividad', 'nombre', 'tipo de actividades', 'descripcion', 'objetivo', 'fecha', 'status'],
                'titulo' => 'Tabla Actividades-Prestadores',
                'ajaxroute' => 'ss.ssActividadTerminada',
                "columnas" => json_encode($columns),
            ]
        );
    }

    public function registro_reporte()
    {
        $encargado_id = auth()->user()->encargado_id;
        // $prestadores = DB::table('users')::where('encargado_id', $encargado_id)->get();
        $prestadores = DB::table('users')->select('id', 'name', 'apellido')->where('id', auth()->user()->id)->get();
        $categorias = DB::table('categorias')->get();
        $actividades = DB::table('actividades')->get();

        return view('/prestador/registro_reporte_prestador', compact('prestadores', 'actividades', 'categorias'));
    }

    public function obtenerActividades(Request $request)
    {
        $categoriaId = $request->input('categoriaId');

        $actividades = DB::table('actividades')
            ->where('id_categoria', $categoriaId)
            ->get();

        return response()->json($actividades);
    }


    public function registro_reporte_guardar(Request $request)
    {

        $nomact = $request->input('nombre');
        $tipo = $request->input('tipo_actividad');
        $desc = $request->input('descripcion');
        $obj = $request->input('objetivo');
        // $tipo_categoria = $request->input('tipo_categoria');
        // $tipo_actividad = $request->input('tipo_actividad');
        $fecha = date('d/m/Y H:m');
        $fecha_realizada = date('d/m/Y');
        $id_prestador = Auth::user()->id;
        $imagen = $request->file('imagen');
        $zip = $request->file('zip');

        $horas = $request->input('horas') ?? 0;
        $minutos = $request->input('minutos') ?? 0;
        $estimacion_tiempo = new \DateTime();
        $estimacion_tiempo->setTime($horas, $minutos);
        $asignado_a = $request->input('asignado_a');
        $creacion_id = auth()->user()->id;

        // info($tipo_categoria);
        // info($tipo_actividad);


        $encargado_id = auth()->user()->encargado_id;

        if ($imagen) {
            $rutaGuardarImg = public_path('/imagen/registros/imagenes');
            $imagenName = date("d-m-Y-H-i-s") . "_" . $request->input('nombre');
            $imagenName = $imagenName . ".jpg";
            $imagen->move($rutaGuardarImg, $imagenName);
            $srcimage = "$imagenName";
        } else {
            $srcimage = null;
        }
        if ($zip) {
            $rutaGuardarzip = public_path('/imagen/registros/zips');
            $zipName = date("d-m-Y-H-i-s") . "_" . $request->input('nombre');
            $zipName = $zipName . ".zip";
            $zip->move($rutaGuardarzip, $zipName);
            $srczip = "$zipName";
        } else {
            $srczip = null;
        }


        $insertar = DB::table('c_actividad')->insertGetId(
            [
                'nombre_act' => $nomact,
                'acti_id' => $tipo,
                // 'tipo_categoria'=>$tipo_categoria,
                'tipo_act'=>$tipo_actividad,
                'descripcion' => $desc,
                'objetivo' => $obj,
                'fecha' => $fecha,
                'status' => 'creado',
                'fecha_realizada' => $fecha_realizada,
                'imagen' => $srcimage,
                'archivo' => $srczip,
                'encargado_id' => $encargado_id,
                'creacion_id' => $creacion_id,
                'estimacion_tiempo' => $estimacion_tiempo,
                'asignado_a' => $asignado_a
            ]
        );

        $insertar2 = DB::table('prestador/actividades_prestadores')->insert(['llave_actividad' => $insertar, 'id_prestador' => $id_prestador]);

        //return $this->horas();
        return redirect('/prestador/home');
    }


    public function actividades_prestadores()
    {
        $userId = Auth::id();

        $actividades = DB::table('c_actividad')
            ->where('asignado_a', auth()->user()->id)
            ->whereIn('status', ['creado', 'terminado', 'en_proceso'])
            ->get();

        return view('/prestador/actividades_prestadores', ['actividades' => $actividades]);
    }

    public function contarTiempoActividad($id_actividad)
    {
        $actividad = DB::table('c_actividad')->where('id_actividad', $id_actividad)->first();

        $user = DB::table('users')->find($id_actividad->creacion_id);


        DB::table('c_actividad')->where('id_actividad', $id_actividad)->update([
            'status' => 'en_proceso',
            'fecha_inicio' => now()
        ]);

        return view('prestador.actividades_prestadores.verActividad', compact('actividad', 'user'));
    }

    public function finalizarActividad($id_actividad)
    {
        $actividad = DB::table('c_actividad')->where('id_actividad', $id_actividad)->first();

        if ($actividad->status == 'en_proceso') {
            $fecha_inicio = new DateTime($actividad->fecha_inicio);
            $fecha_fin = now();
            $diferencia_segundos = strtotime($fecha_fin) - strtotime($actividad->fecha_inicio);
            // $tiempo_real = $diferencia_segundos->format('%H:%I:%S');

            DB::table('c_actividad')->where('id_actividad', $id_actividad)
                ->update(['status' => 'terminado', 'fecha_fin' => now(), 'tiempo_real' => $diferencia_segundos]);

            return redirect()->route('prestador/actividades_prestadores')->with('success', 'La actividad ha sido finalizada exitosamente.');
        }

        return redirect()->route('prestador/actividades_prestadores')->with('error', 'La actividad no se puede finalizar.');
    }

    public function actividades_creadas()
    {
        $userId = Auth::id();

        $actividades = DB::table('c_actividad')
            ->where('asignado_a', auth()->user()->id)
            ->whereIn('status', ['creado'])
            ->get();

        return view('prestador/actividades_prestadores', ['actividades' => $actividades, 'title' => 'Actividades Creadas','breadcrumb'=>'Actividades creadas']);
    }

    public function enProcesoActividad($id)
    {

        DB::table('c_actividad')->where('id_actividad', $id)->update([
            'status' => 'en_proceso',
            'fecha_inicio' => now()
        ]);
        $actividad = DB::table('c_actividad')->where('id_actividad', $id)->first();
        $user = DB::table('users')->find($actividad->creacion_id);

        return view('prestador.actividades_prestadores.verActividad', compact('actividad', 'user'));
    }

    public function retomarActividad($id_actividad)
    {

        DB::table('c_actividad')->where('id_actividad', $id_actividad)->update([
            'status' => 'en_proceso',
        ]);
        $actividad = DB::table('c_actividad')->where('id_actividad', $id_actividad)->first();
        $user = DB::table('users')->find($actividad->creacion_id);

        return view('prestador.actividades_prestadores.verActividad', compact('actividad', 'user'));
    }

    public function actividades_en_proceso()
    {
        $actividades = DB::table('c_actividad')
            ->where('asignado_a', auth()->user()->id)
            ->whereIn('status', ['en_proceso'])
            ->get();

        return view('prestador/actividades_prestadores', ['actividades' => $actividades, 'title' => 'Actividades en Proceso', 'breadcrumb'=>'Activiadades terminadas']);
    }

    public function actividadesTerminadas()
    {
        $actividades = DB::table('c_actividad')
            ->where('asignado_a', auth()->user()->id)
            ->whereIn('status', ['terminado'])
            ->get();

        return view('prestador/actividades_prestadores', ['actividades' => $actividades, 'title' => 'Actividades Terminadas en Revisión','breadcrumb'=>'Actividades en revisión']);
    }

    public function actividades_prestadores_revisadas()
    {
        $actividades = DB::table('c_actividad')
            ->where('asignado_a', auth()->user()->id)
            ->whereIn('status', ['terminado_revisado'])
            ->get();

        return view('prestador/actividades_prestadores', ['actividades' => $actividades, 'title' => 'Actividades Revisadas','breadcrumb'=>'Actididades revisadas']);
    }

    public function actividades_canceladas()
    {
        $actividades = DB::table('c_actividad')
            ->where('asignado_a', auth()->user()->id)
            ->whereIn('status', ['cancelado', 'cancelado_permitido'])
            ->get();

        return view('prestador/actividades_prestadores', ['actividades' => $actividades, 'title' => 'Actividades con error','breadcrumb'=>'Actividades con error']);
    }


    // public function terminarActividad($id_actividad){

    //     DB::table('c_actividad')->where('id_actividad', $id_actividad)->update([
    //         'status' => 'terminado',
    //         'fecha_fin' => now()
    //     ]);

    //     $actividad = DB::table('c_actividad')->where('id_actividad', $id_actividad)->first();

    //     return view('actividadesPrestadores.verActividad', compact('actividad'));
    // }

    public function terminarActividad($id_actividad)
    {
        $actividad = DB::table('c_actividad')->where('id_actividad', $id_actividad)->first();

        $fecha_inicio = new \DateTime($actividad->fecha_inicio);
        $fecha_fin = new \DateTime();
        $duracion = $fecha_inicio->diff($fecha_fin)->format('%H:%I:%S');

        DB::table('c_actividad')->where('id_actividad', $id_actividad)->update([
            'status' => 'terminado',
            'fecha_fin' => now(),
            'duracion' => $duracion
        ]);

        $actividad = DB::table('c_actividad')->where('id_actividad', $id_actividad)->first();
        $user = DB::table('users')->find($actividad->creacion_id);

        return view('prestador.actividades_prestadores.verActividad', compact('actividad', 'user'));
    }

    public function perfil()
    {
        $user = Auth::user();

        $sede = DB::table('sede')
        ->select('sede.nombre_Sede', 'sede.id_Sede')
        ->where('sede.id_Sede', '=', $user->sede ?? "No definida") // Si la sede es null, establece la experiencia acumulada en 0.
        ->first();

        $nivel = DB::table('niveles')
            ->join('medallas', 'niveles.nivel', '=', 'medallas.nivel')
            ->select('niveles.nivel', 'medallas.ruta', 'medallas.descripcion', 'medallas.ruta_n')
            ->where('niveles.experiencia_acumulada', '<=', $user->experiencia ?? 1) // Si la experiencia es null, establece la experiencia acumulada en 0.
            ->orderByDesc('niveles.experiencia_acumulada')
            ->first();
        $todasMedallasUsuario = DB::table('niveles')
                ->join('medallas', 'niveles.nivel', '=', 'medallas.nivel')
                ->select('medallas.ruta', 'medallas.nivel', 'medallas.descripcion')
                ->where('niveles.experiencia_acumulada', '<=', $user->experiencia ?? 0) // Si la experiencia es null, establece la experiencia acumulada en 0.
                ->orderBy('niveles.experiencia_acumulada', 'asc')
                ->get();

        // Convertimos el valor del nivel a una cadena de texto
        $nivel_str = strval($nivel->nivel);

        $medalla = asset($nivel->ruta);
        //dd($nivel); // Verificar si la propiedad ruta_n está presente en $nivel
        // Descripcion de la medalla
        $descripcion_medalla = $nivel->descripcion;

        return view('prestador.newProfile', compact('user', 'sede', 'nivel_str', 'medalla', 'nivel', 'descripcion_medalla', 'todasMedallasUsuario'));
    }

    public function cambiarImagenPerfil(Request $request)
    {
        $request->validate([
            'imagen_perfil' => 'required|image|max:4096', // la imagen debe ser de tipo imagen y tener un tamaño máximo de MB
        ], [
            'imagen_perfil.max' => 'La imagen debe pesar menos de 4MB',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Eliminar la imagen del usuario si es que ya tenia
        if ($user->imagen_perfil) {
            // $image_path = public_path('storage/imagen/imagen/' . $user->imagen_perfil);
            $image_path = public_path('storage/userImg/'.$user->imagen_perfil);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }


        // Almacenar la nueva imagen
        $imagen_path = $request->file('imagen_perfil')->store('public/userImg/');

        $nombre_archivo = basename($imagen_path);

        // Actualizar el campo 'imagen_perfil' del usuario
        $user->imagen_perfil =  $nombre_archivo;

        $user->save();

        // Redireccionar al perfil del usuario
        return redirect()->route('perfil')->with('success', 'Imagen cambiada correctamente');
    }

    function obtenerTodasActividades()
    {
        // Obtener el ID y el tipo de usuario autenticado
        $userId = Auth::id();
        $userType = Auth::user()->tipo;

        // Verificar si el usuario es "Superadmin"
        if ($userType === 'Superadmin') {
            // Si es "Superadmin", retornar la cantidad total de registros (todos)
            $cantidad = DB::table('c_actividad')
                ->count();
        } else {
            // Si no es "Superadmin", filtrar por el ID del usuario autenticado
            $cantidad = DB::table('c_actividad')
                ->where('asignado_a', $userId)
                ->where('status', '!=', 'cancelacion_prestador')
                ->count();
        }

        return $cantidad;
    }

    function obtenerCantidadActividadesCreadas()
    {
        // Obtener el ID y el tipo de usuario autenticado
        $userId = Auth::id();
        $userType = Auth::user()->tipo;

        // Verificar si el usuario es "Superadmin"
        if ($userType === 'Superadmin') {
            // Si es "Superadmin", retornar la cantidad total de registros (todos)
            $cantidad = DB::table('c_actividad')
                ->where('status', 'creado')
                ->count();
        } else {
            // Si no es "Superadmin", filtrar por el ID del usuario autenticado
            $cantidad = DB::table('c_actividad')
                ->where('status', 'creado')
                ->where('asignado_a', $userId)
                ->count();
        }

        return $cantidad;
    }

    function obtenerCantidadActividadesEnProceso()
    {
        // Obtener el ID y el tipo de usuario autenticado
        $userId = Auth::id();
        $userType = Auth::user()->tipo;

        // Verificar si el usuario es "Superadmin"
        if ($userType === 'Superadmin') {
            // Si es "Superadmin", retornar la cantidad total de registros (todos)
            $cantidad = DB::table('c_actividad')
                ->where('status', 'en_proceso')
                ->count();
        } else {
            // Si no es "Superadmin", filtrar por el ID del usuario autenticado
            $cantidad = DB::table('c_actividad')
                ->where('status', 'en_proceso')
                ->where('asignado_a', $userId)
                ->count();
        }

        return $cantidad;
    }

    function obtenerCantidadActividadesEnRevision()
    {
        // Obtener el ID y el tipo de usuario autenticado
        $userId = Auth::id();
        $userType = Auth::user()->tipo;

        // Verificar si el usuario es "Superadmin"
        if ($userType === 'Superadmin') {
            // Si es "Superadmin", retornar la cantidad total de registros (todos)
            $cantidad = DB::table('actividad_completada_2')
                ->count();
        } else {
            // Si no es "Superadmin", filtrar por el ID del usuario autenticado
            $cantidad = DB::table('actividad_completada_2')
                ->where('asignado_a', $userId)
                ->count();
        }

        return $cantidad;
    }

    function obtenerCantidadActividadesConError()
    {
        // Obtener el ID y el tipo de usuario autenticado
        $userId = Auth::id();
        $userType = Auth::user()->tipo;

        // Verificar si el usuario es "Superadmin"
        if ($userType === 'Superadmin') {
            // Si es "Superadmin", retornar la cantidad total de registros (todos)
            $cantidad = DB::table('c_actividad')
                ->where('status', 'cancelado_permitido')
                ->count();
        } else {
            // Si no es "Superadmin", filtrar por el ID del usuario autenticado
            $cantidad = DB::table('c_actividad')
                ->where('status', 'cancelado_permitido')
                ->where('asignado_a', $userId)
                ->count();
        }

        return $cantidad;
    }

    function obtenerCantidadActividadesTerminadas()
    {
        // Obtener el ID y el tipo de usuario autenticado
        $userId = Auth::id();
        $userType = Auth::user()->tipo;

        // Verificar si el usuario es "Superadmin"
        if ($userType === 'Superadmin') {
            // Si es "Superadmin", retornar la cantidad total de registros (todos)
            $cantidad = DB::table('actividad_terminada_2')
                ->count();
        } else {
            // Si no es "Superadmin", filtrar por el ID del usuario autenticado
            $cantidad = DB::table('actividad_terminada_2')
                ->where('asignado_a', $userId)
                ->count();
        }

        return $cantidad;
    }

    public function cancelacion_prestador(Request $request)
    {
        $id_actividad = $request->input('id_actividad');
        $motivoCancelacion = $request->input('motivo_cancelacion');

        $modificar = DB::table('c_actividad')->where('id_actividad', $id_actividad)->update(
                [
                    'status' => 'cancelacion_prestador',
                    'nota_error' => $motivoCancelacion,
                    'duracion' => null,
                    'fecha_fin' => null
                ]
            );
        return redirect()->back()->with('success', 'La actividad ha sido cancelada exitosamente.');

    }

    public function asistencias(){
        return view('prestador.asistencias_prestador');
    }

    public function faltas(){
        return view('prestador.faltas_prestador');
    }

    public function cambiarRol()
    {
        if (Auth::user()->can_admin == 1) {

                $user = User::find(Auth::user()->id);
                if($user->tipo == "prestador"){
                    $user->tipo="encargado";
                    $user->save();
                }
                return redirect('/admin/home');
        }
    }

    public function show_reportes(){
        return view('prestador.reportes_parciales');
    }

    public function subir_reportes_parciales(Request $request){
        $request->validate([
            'reporte_parcial' => 'required|mimes:jpg,jpeg,png,pdf|max:4096', //El archivo debe ser de tipo imagen y tener un tamaño máximo de MB
        ], [
            'reporte_parcial.max' => 'El archivo debe pesar menos de 4MB',
        ]);

        // Obtener el usuario autenticado
        $user_id = Auth::user()->id;


        // Almacenar el archivo
        $reporte_path = $request->file('reporte_parcial')->store('public/reportes_parciales/');

        $nombre_archivo = basename($reporte_path);
        $insertar= DB::table('reportes_s_s')->insert(['id_prestador' => $user_id, 'nombre_reporte' => $user_id, 'ruta_reporte'=>$reporte_path, 'fecha_subida' => date("Y/m/d")]);
        
        return redirect()->route('parciales')->with('success', 'Archivo subido con éxito');
    }
}
