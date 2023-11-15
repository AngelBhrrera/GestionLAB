<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use DateTime;


class PrestadorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function home(){
        $id = Auth::user()->id;
        $horasAutorizadas = DB::table('horasprestadores')->where('idusuario', $id)->where('estado', 'autorizado')->sum('horas');
        $horasPendientes = DB::table('horasprestadores')->where('idusuario', $id)->where('estado', 'pendiente')->sum('horas');
        $horasTotales = DB::table('users')->where('id', $id)->select('horas')->get();
        $horasRestantes = $horasTotales[0]->horas - $horasAutorizadas;

        return view(
            'prestador/newHomeP',
            [
                'horasAutorizadas' => $horasAutorizadas,
                'horasPendientes' => $horasPendientes,
                'horasTotales'=> $horasTotales[0]->horas,
                'horasRestantes' => $horasRestantes
            ]
        );
    }

    public function horas()
    {
        $columns = array(["data" => "id", "visible" => false], ["data" => "fecha"], ["data" => "hora_entrada", "sortable" => false], ["data" => "hora_salida", "sortable" => false], ["data" => "tiempo"], ["data" => "horas"], ["data" => "estado", "sortable" => false], ["data" => "nota", "sortable" => false]);
        $id = Auth::user()->id;
        $horas = DB::table('horasprestadores')->where('idusuario', $id)->where('estado', 'autorizado')->sum('horas');
        $horasT = DB::table('users')->where('id', $id)->select('horas')->get();

        return view(
            'prestador/homeP',
            [
                'datos' => ['id', 'fecha', 'hora_entrada', 'hora_salida', 'tiempo', 'horas', 'estado', 'nota'],
                'titulo' => 'Registro de horas',
                'button' => false,
                'accion' => false,
                'fecha' => date("d/m/Y"),
                'ajaxroute' => 'ss.sstablaprestadores',
                "columnas" => json_encode($columns),
                'cursos' => false,
                'horas' => $horas,
                'horasT' => $horasT[0]->horas - $horas,
                'modal' => true,
                'descarga' => false
            ]
        );
    }

    public function marcar(Request $request)
    {

        try {
            $dir = '';
            switch (Auth::user()->tipo) {
                case 'admin':
                    $dir = 'admin.checkin';
                    $origen = Auth::user()->name . ' ' . Auth::user()->apellido;
                    break;
                case 'Superadmin':
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
                    ->orWhere('tipo', '=', "clientes");
            })
                ->select('name', 'id', 'apellido', 'tipo', 'encargado_id')->get();
            $verificar = DB::table('horasprestadores')->where('idusuario', $usuario[0]->id)->where('fecha', date("d/m/Y"))->where('hora_salida', null)->exists();
            if ($verificar) {
                $hor = date('H:i:s');
                $tiempo = DB::table('horasprestadores')->select('hora_entrada')->where('idusuario', $usuario[0]->id)->where('fecha', date("d/m/Y"))->where('hora_salida', null)->get();
                $tiempoCompleto = $this->diferencia($tiempo[0]->hora_entrada, $hor);
                $salida = DB::table('horasprestadores')->where('idusuario', $usuario[0]->id)->where('fecha', date("d/m/Y"))->where('hora_salida', null)->update(['hora_salida' => $hor, 'tiempo' => $tiempoCompleto, 'horas' => $this->horasC($tiempoCompleto)]);
                return redirect()->route($dir)->with('success', 'Adios ' . $usuario[0]->name);
            } else {
                $inicio = DB::table('horasprestadores')->insert([['origen' => $origen, 'idusuario' => $usuario[0]->id, 'codigo' => $codigo, 'nombre' => $usuario[0]->name, 'apellido' => $usuario[0]->apellido, 'fecha' => date("d/m/Y"), 'hora_entrada' => date('H:i:s'), 'horas' => 0, 'tipo' => $usuario[0]->tipo, 'encargado_id' => $usuario[0]->encargado_id]]);
                return redirect()->route($dir)->with('success', 'Bienvenido ' . $usuario[0]->name . '!');
            }
        } catch (\Throwable $th) {

            return redirect()->route($dir)->with('error', $th->getMessage());
        }
    }
    public function asirgarfirmas(Request $request)
    {
        $id = $request->input('id');
        $horas = $request->input('horas');
        $nota = $request->input('nota');
        $pdf = $request->input('pdf');
        $usuario = DB::table('users')->where('id', $id)->where('tipo', 'prestador')->select('name', 'id', 'apellido', 'codigo')->get();
        $inicio = DB::table('horasprestadores')->insert([['origen' => 'Superadmin', 'idusuario' => $usuario[0]->id, 'codigo' => $usuario[0]->codigo, 'nombre' => $usuario[0]->name, 'apellido' => $usuario[0]->apellido, 'fecha' => date("d/m/Y"), 'hora_entrada' => 'no aplica', 'hora_salida' => 'no aplica', 'horas' => $horas, 'nota' => $nota, 'pdf' => $pdf, 'tiempo' => 'no aplica', 'estado' => 'autorizado', 'responsable' => $request->input('responsable')]]);
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

        $modificar = DB::table('horasprestadores')->where('id', $id)->update(['nota' => $nota, 'srcimagen' => $srcimage]);
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

    public function horario()
    {


        return view('/prestador/horario_prestador');
    }

    public function regitro_reporte()
    {
        $encargado_id = auth()->user()->encargado_id;
        // $prestadores = DB::table('users')::where('encargado_id', $encargado_id)->get();
        $prestadores = DB::table('users')->select('id', 'name')->where('encargado_id', $encargado_id)->get();
        $categorias = DB::table('categorias')->get();
        $actividades = DB::table('actividades')->get();

        return view('/prestador/registro_reporte_prestador', compact('prestadores', 'actividades', 'categorias'));
    }

    public function obtenerActividades(Request $request)
    {
        $categoriaId = $request->input('categoriaId');

        $actividades = DB::table('actividades')
            ->where('categoria_id', $categoriaId)
            ->get();

        return response()->json($actividades);
    }


    public function regitro_reporte_guardar(Request $request)
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
                // 'tipo_actividad'=>$tipo_actividad,
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

        return view('prestador/actividades_prestadores', ['actividades' => $actividades, 'title' => 'Actividades Creadas']);
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

        return view('prestador/actividades_prestadores', ['actividades' => $actividades, 'title' => 'Actividades en Proceso']);
    }

    public function actividadesTerminadas()
    {
        $actividades = DB::table('c_actividad')
            ->where('asignado_a', auth()->user()->id)
            ->whereIn('status', ['terminado'])
            ->get();

        return view('prestador/actividades_prestadores', ['actividades' => $actividades, 'title' => 'Actividades Terminadas en Revisión']);
    }

    public function actividades_prestadores_revisadas()
    {
        $actividades = DB::table('c_actividad')
            ->where('asignado_a', auth()->user()->id)
            ->whereIn('status', ['terminado_revisado'])
            ->get();

        return view('prestador/actividades_prestadores', ['actividades' => $actividades, 'title' => 'Actividades Revisadas']);
    }

    public function actividades_canceladas()
    {
        $actividades = DB::table('c_actividad')
            ->where('asignado_a', auth()->user()->id)
            ->whereIn('status', ['cancelado', 'cancelado_permitido'])
            ->get();

        return view('prestador/actividades_prestadores', ['actividades' => $actividades, 'title' => 'Actividades con error']);
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

        $nivel = DB::table('niveles')
            ->join('medallas', 'niveles.nivel', '=', 'medallas.nivel')
            ->select('niveles.nivel', 'medallas.ruta', 'medallas.descripcion')
            ->where('niveles.experiencia_acumulada', '<=', $user->experiencia ?? 1) // Si la experiencia es null, establece la experiencia acumulada en 0.
            ->orderByDesc('niveles.experiencia_acumulada')
            ->first();

        $todasMedallasUsuario = DB::table('niveles')
                ->join('medallas', 'niveles.nivel', '=', 'medallas.nivel')
                ->select('medallas.ruta', 'medallas.descripcion')
                ->where('niveles.experiencia_acumulada', '<=', $user->experiencia ?? 0) // Si la experiencia es null, establece la experiencia acumulada en 0.
                ->orderBy('niveles.experiencia_acumulada', 'asc')
                ->get();

        // Convertimos el valor del nivel a una cadena de texto
        $nivel_str = strval($nivel->nivel);

        $medalla = asset($nivel->ruta);

        // Descripcion de la medalla
        $descripcion_medalla = $nivel->descripcion;


        return view('prestador/perfil_prestador', compact('user', 'nivel_str', 'medalla', 'nivel', 'descripcion_medalla', 'todasMedallasUsuario'));
    }

    public function cambiarImagenPerfil(Request $request)
    {
        $request->validate([
            'imagen_perfil' => 'required|image|max:4096', // la imagen debe ser de tipo imagen y tener un tamaño máximo de 2MB
        ], [
            'imagen_perfil.max' => 'La imagen debe pesar menos de 4MB',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Eliminar la imagen del usuario si es que ya tenia
        if ($user->imagen_perfil) {
            // $image_path = public_path('storage/imagen/imagen/' . $user->imagen_perfil);
            $image_path = public_path('/public/imagen/' . $user->imagen_perfil);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }


        // Almacenar la nueva imagen
        $imagen_path = $request->file('imagen_perfil')->store('imagen', 'public');


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

}
