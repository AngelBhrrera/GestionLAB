<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use DateTime;


class PrestadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(){

        $horasAutorizadas = DB::table('seguimiento_horas_completo')->where('id',Auth::user()->id)->value('horas_servicio');
        $horasRestantes = DB::table('seguimiento_horas_completo')->where('id', Auth::user()->id)->value('horas_restantes');
        $horasPendientes = DB::table('registros_checkin')->where('idusuario',Auth::user()->id)->where('estado', 'pendiente')->sum('horas');
        $horasTotales = DB::table('users')->where('id',Auth::user()->id)->value('horas');
        
        $asistencias = DB::table('registros_checkin')
            ->where('idusuario', Auth::user()->id)
            ->orderBy('fecha_actual', 'desc')
            ->limit(5)
            ->get();


        $leaderboard = $this->consultarLeaderboard('lb_at', Auth::user()->area, 'area',10); 
        $leaderboardSede = $this->consultarLeaderboard('lb_at', Auth::user()->sede, 'sede',10);

        $usuarioMedalla = $this->prestador_level();

        return view(
            'prestador/newHomeP',  
            compact('horasAutorizadas', 'horasPendientes', 'horasTotales', 'horasRestantes',  
            'leaderboard', 'leaderboardSede', 'usuarioMedalla')
        )->with('asistencias', json_encode($asistencias));
    }
    
    public function horas()
    {
        $asistencias = DB::table('registros_checkin')
            ->where('idusuario', Auth::user()->id)
            ->orderBy('fecha_actual', 'desc')
            ->get();

        return view('prestador/registro_horas', ['datos' => json_encode($asistencias)]);
    }

    public function checkInOrigin($area){
        $dir = '';
        $responsable = Auth::user()->name . ' ' . Auth::user()->apellido;
        $verifArea = false;
        switch (Auth::user()->tipo) {
            case 'Superadmin':
                $dir = 'admin.checkin';
                $verifArea =  true;
                break;
            case 'jefe area':
            case 'coordinador':
                $dir = 'admin.checkin';
                $verifArea = $area == Auth::user()->area;
                break;
            case 'checkin':
                $dir = 'api.checkin';
                $responsable = 'checkin';
                $verifArea = $area == Auth::user()->area;
                break;
        };

        return compact('dir', 'responsable', 'verifArea');
    }

    public function checkEntrada($id){
        $verificar = DB::table('registros_checkin')
        ->where('idusuario', $id)
        ->where('fecha', date("d/m/Y"))
        ->where('hora_salida', null)->exists();

        return $verificar;
    }

    public function obtenerUbicacion(){

        $ip = $_SERVER['REMOTE_ADDR'];
        $geo = file_get_contents("http://ip-api.com/json/{$ip}");
        $geoData = json_decode($geo);

        if ($geoData && $geoData->status == 'success') {
            $latitud = $geoData->lat;
            $longitud = $geoData->lon;
            $enlaceMaps = "https://www.google.com/maps?q={$latitud},{$longitud}";
        } else {
            $enlaceMaps = "https://www.google.com/maps?q=20.6568344,-103.3273073";
        }
        return $enlaceMaps;
    }

    public function marcarEntrada($user, $fuenteCheckin){
        $origen = $user->name . " " . $user->apellido;

        $ubicacion = $this->obtenerUbicacion();
        DB::table('registros_checkin')
            ->insert([['origen' => $origen, 'idusuario' => $user->id, 'fecha' => date("d/m/Y"), 'ubicacion' => $ubicacion,
            'hora_entrada' => date('H:i:s'), 'horas' => 0, 'responsable'=>  $fuenteCheckin['responsable'], 'tipo' => $user->tipo,
            'encargado_id' => Auth::user()->id]]);

        return 0;
    }

    public function marcarSalida($user){
            
        $hor = date('H:i:s');
        $tiempo = DB::table('registros_checkin')
            ->select('hora_entrada')
            ->where('idusuario', $user->id)
            ->where('fecha', date("d/m/Y"))
            ->where('hora_salida', null)->get();
        $tiempoCompleto = $this->diferencia($tiempo[0]->hora_entrada, $hor);

        DB::table('registros_checkin')
            ->where('idusuario', $user->id)
            ->where('fecha', date("d/m/Y"))
            ->where('hora_salida', null)
            ->update(['hora_salida' => $hor, 'tiempo' => $tiempoCompleto, 'horas' => $this->calculoIntervaloH($tiempoCompleto)]);

        return 0;
    }

    private function checkHora($horaActual, $horaInicio, $horaFin) {
        return ($horaActual >= $horaInicio && $horaActual <= $horaFin);
    }

    public function checkTurno($turno){
        $hor = date('H:i:s');
    
        if($turno == 'Matutino' ){
            return $this->checkHora($hor, '07:30:00', '09:45:00');
        } else if($turno == 'Mediodia'){
            return $this->checkHora($hor, '11:30:00', '13:45:00');
        } else if($turno == 'Vespertino'){
            return $this->checkHora($hor, '15:30:00', '17:45:00');
        } else {
            return true;
        }
    }

    public function marcar(Request $request)
    {
        $codigo = $request->input('codigo');
        $refArea =  DB::table('users')
            ->where('codigo', $codigo)
            ->value('area');
        $fuenteCheckin = $this->checkinOrigin($refArea);

        try {
           
            $user = DB::table('users')
                ->select('id','name','apellido','tipo','horario')
                ->where('codigo', $codigo)
                ->where(function ($query) {
                    $query->whereIn('tipo', ["prestador", "coordinador", "voluntario", "practicante"]);
                })
                ->first();
           
            if($user != null){

                if($fuenteCheckin['verifArea']){
                    $verificar = $this->checkEntrada($user->id);

                    //CHECK DE SALIDA
                    if ($verificar) {
                        $this->pauseActP($user->id);
                        $this->marcarSalida($user);
                        return redirect()->route( $fuenteCheckin['dir'])->with('success', 'Adios ' . $user->name);

                    //CHECK DE ENTRADA
                    }else{

                        $this->marcarEntrada($user, $fuenteCheckin);
                        return redirect()->route( $fuenteCheckin['dir'])->with('success', 'Bienvenido/a ' . $user->name);
                        
                        if($this->checkTurno($user->horario)){
                            $this->marcarEntrada($user, $fuenteCheckin);
                            return redirect()->route( $fuenteCheckin['dir'])->with('success', 'Bienvenido/a ' . $user . '!');
                        }else{
                            $msg = "El prestador pertenece a otro turno";
                            return redirect()->route( $fuenteCheckin['dir'])->with('error', $msg);
                        }
                    }
                }else{
                    $msg = "El codigo ingresado no corresponde a la sede.";
                    return redirect()->route( $fuenteCheckin['dir'])->with('error', $msg);
                }
            }else{
                $msg = "El codigo ingresado no corresponde a ningun usuario válido";
                return redirect()->route( $fuenteCheckin['dir'])->with('error', $msg);
            }
        } catch (\Throwable $th) {
            return redirect()->route($fuenteCheckin['dir'])->with('error', $th->getMessage());
        }
    }

    function diferencia($hora, $hora2)
    {
        $time1 = new DateTime($hora);
        $time2 = new DateTime($hora2);
        $interval = $time1->diff($time2);
        return $interval->format('%H:%I:%S');
    }

    function calculoIntervaloH($time)
    {
        $horas = new DateTime($time);
        $tiempo = $horas->format('H.i');
        if (fmod($tiempo, 1) > 0.30) {
            $tiempo = $tiempo + 1;
        }
        return intval($tiempo);
    }

    function calculoIntervaloM($hora,$hora2)
    { 
        $time1 = new DateTime($hora);
        $time2 = new DateTime($hora2);
        $interval = $time1->diff($time2);
        $totalMinutos = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i; 
        return $totalMinutos;
    }

    public function cambiarRol()
    {
        return redirect()->route('admin.home');
    }

    //VER ACTIVIDADES Y AGREGAR DETALLES

    public function misActividades()
    {

        $actividades = DB::table('actividades_prestadores')
            ->select('actividades_prestadores.*', 'actividades.TEC', 'actividades.titulo')
            ->join('actividades', 'actividades.id', '=', 'actividades_prestadores.id_actividad')
            ->where('actividades_prestadores.id_prestador', auth()->user()->id)
            ->get();

        return view('/prestador/actividades_prestador', [ 'impresiones' =>json_encode($actividades)]);
    }

    public function detail_act($id, $value) {

        $sql= DB::table('actividades_prestadores')
            ->where('id', $id)
            ->update(['detalles' => $value]);

        return response()->json(['message' => $sql]);
    }

    public function detallesActividad($value)
    {

        $detalles = DB::table('actividades')
            ->select('actividades.*', 'categorias.nombre AS nombre_categoria', 'subcategorias.nombre AS nombre_subcategoria')
            ->join('categorias', 'actividades.id_categoria', '=', 'categorias.id')
            ->leftJoin('subcategorias', 'actividades.id_subcategoria', '=', 'subcategorias.id') 
            ->where('actividades.id', $value)
            ->first();

        return view('/prestador/detalles_actividad', [ 'detalle' => $detalles]);
    }

    //VER PROYECTOS

    public function myProject()
    {
        $id = DB::table('proyectos_prestadores')
            ->where('id_prestador', auth()->user()->id)
            ->value('id_proyecto');
        $proyecto = DB::table('proyectos')
            ->where('id',$id)
            ->value('titulo');
        $prestadores = DB::table('proyectos_prestadores')
            ->select('id_prestador', 'name', 'apellido', 'correo', 'telefono')
            ->where('id_proyecto', $id)
            ->join('users', 'id_prestador','=','users.id')
            ->get();
        $actividades = DB::table('seguimiento_actividades')
            ->select('actividad_id','actividad', 'estado', 'prestador')
            ->where('id_proyecto', $id)
            ->get();

        return view('/prestador/mi_proyecto_prestador', compact('prestadores', 'actividades', 'proyecto'));
    }

    //SISTEMA DE ACTIVIDADES GAMIFICADO

    public function actividadesAsignadas()
    {
        $proys = DB::table('proyectos_prestadores')
            ->where('id_prestador', auth()->user()->id)
            ->pluck('id_proyecto');

        $actividades = DB::table('seguimiento_actividades')
            ->where('id_prestador', auth()->user()->id)
            ->whereNotIn('estado', ['Aprobada'])
            ->orWhere(function($query) use ($proys) {
                $query->whereIn('id_proyecto', $proys)
                        ->where('id_prestador', 0);
            })
            ->orderByDesc('fecha')
            ->get();

        return view('/prestador/actividades_asignadas',compact('actividades'));
    }

    public function actPull()
    {
        $proys = DB::table('proyectos')
            ->leftJoin('proyectos_prestadores', 'proyectos.id', '=', 'proyectos_prestadores.id_proyecto')
            ->whereNull('proyectos_prestadores.id_proyecto')
            ->pluck('proyectos.id');

        $acts = DB::table('seguimiento_actividades')
            ->where('id_prestador', 0)
            ->whereIn('id_proyecto', $proys)
            ->get();

        return view('/prestador/actividades_abiertas', ['actividades' =>$acts]);
    }

    public function startAct($id, $teu){

        $hor = date('H:i:s');

        $verificar = $this->checkEntrada(auth()->user()->id);

        $disponible = DB::table('actividades_prestadores')
            ->where('id_prestador', auth()->user()->id)
            ->orWhere('id_prestador', 0)
            ->where('id', $id)
            ->exists();

        if($disponible && $verificar){

            if($this->checkAct()){
                $this->pauseAct();
            }
            
            DB::table('actividades_prestadores')
            ->where('id', $id)
            ->update([
                'id_prestador' => auth()->user()->id,
                'estado' => 'En Proceso',
                'hora_refs' => $hor,
                'TEU' => $teu
            ]);

        }else{
            return response()->json(['message' => 'NO has realizado check de entrada']);
        }

        return response()->json(['mensaje' => 'Actividad iniciada correctamente para la actividad con ID ' . $id]);
    }

    public function takeAct($id, $teu){

        $hor = date('H:i:s');

        $verificar = $this->checkEntrada(auth()->user()->id);

        $disponible = DB::table('actividades_prestadores')
            ->where('id_prestador', auth()->user()->id)
            ->orWhere('id_prestador', 0)
            ->where('id', $id)
            ->exists();

        if($disponible && $verificar){
            if($this->checkAct()){
                $this->pauseAct();
            }
            DB::table('actividades_prestadores')
            ->where('id', $id)
            ->update([
                'id_prestador' => auth()->user()->id,
                'estado' => 'En Proceso',
                'hora_refs' => $hor,
                'TEU' => $teu
            ]);
        }else{
            return redirect()->route('actividadesAsignadas')->with('error', 'No has hecho Check de entrada');
        }

        return response()->json(['mensaje' => 'Actividad iniciada correctamente para la actividad con ID ' . $id]);
    }

    public function checkAct(){

        $actual = DB::table('actividades_prestadores')
            ->where('id_prestador', auth()->user()->id)
            ->where('estado', 'En proceso')
            ->exists();

        return $actual;
    }

    public function pauseAct(){

        $found = DB::table('actividades_prestadores')
            ->where('id_prestador',  auth()->user()->id)
            ->where('estado', 'En proceso')
            ->value('id');

        DB::table('actividades_prestadores')
            ->where('id', $found)
            ->update(['estado' => 'Bloqueada']);

        return 0;
    }

    public function pauseActP($id){

        $found = DB::table('actividades_prestadores')
            ->where('id_prestador', $id)
            ->where('estado', 'En proceso')
            ->value('id');

        DB::table('actividades_prestadores')
            ->where('id', $found)
            ->update(['estado' => 'Bloqueada']);

        return 0;
    }

    public function statusAct($id, $mode)
    {

        $verificar = $this->checkEntrada(auth()->user()->id);
        if($verificar){
            if($this->checkAct()){
                $this->pauseAct();
            }
    
            if($mode == 1){
                $hor = date('H:i:s');
    
                DB::table('actividades_prestadores')
                ->where('id', $id)
                ->update([
                    'estado' => 'En Proceso',
                    'hora_refs' => $hor
                ]);
    
                return response()->json(['mensaje' => 'AOK']);
                
            }else if($mode == 2){
    
                $timeRef = DB::table('actividades_prestadores')
                    ->where('id', $id)
                    ->value('hora_refs');
                $timeRef2 = date('H:i:s');
    
                $tiempoInvertido = DB::table('actividades_prestadores')
                    ->where('id', $id)
                    ->value('Tiempo_Invertido');
    
                $intervalCalc = $this->calculoIntervaloM($timeRef, $timeRef2);
                $tiempoInvertido += $intervalCalc;
    
                DB::table('actividades_prestadores')
                ->where('id', $id)
                ->update([
                    'estado' => 'Bloqueada',
                    'Tiempo_Invertido' => $tiempoInvertido
                ]);
    
                return response()->json(['mensaje' => 'BOK']);

            }else if($mode == 3){

                $timeRef = DB::table('actividades_prestadores')
                ->where('id', $id)
                ->value('hora_refs');
                $timeRef2 = date('H:i:s');
    
                $tiempoInvertido = DB::table('actividades_prestadores')
                    ->where('id', $id)
                    ->value('Tiempo_Invertido');
    
                $intervalCalc = $this->calculoIntervaloM($timeRef, $timeRef2);
                $tiempoInvertido += $intervalCalc;
    
                DB::table('actividades_prestadores')
                ->where('id', $id)
                ->update([
                    'estado' => 'Bloqueada',
                    'Tiempo_Invertido' => $tiempoInvertido
                ]);
    
    
                if($tiempoInvertido > 0){
                    DB::table('actividades_prestadores')
                    ->where('id', $id)
                    ->update([
                        'estado' => 'En revision'
                    ]);
                }else{
                    return response()->json(['mensaje' => 'ERROR, finalizaste una tarea sin tiempo invertido']);
                }
                return response()->json(['mensaje' => 'COK']);
            }
        }
        
        return response()->json(['mensaje' => 'ERROR, no hay check de entrada']);
    }

    //CREACION DE ACTIVIDADES COMO PRESTADOR

    public function create_act()
    {
        $categorias = DB::table('categorias')->get();
        $subcategorias = DB::table('subcategorias')->get();
    
        return view('/prestador/registro_nActividad_prestador', compact('categorias', 'subcategorias'));
    }

    public function make_act(Request $request)
    {

        $subcategoria = $request->input('tipo_subcategoria');
        if($subcategoria == '')
            $subcategoria = null;
    
        DB::table('actividades')->insert([
            'titulo' => $request->input('nombre'),
            'id_categoria' =>  $request->input('tipo_categoria'),
            'id_subcategoria' => $subcategoria,
            'tipo' => $request->input('tipo_actividad'),                
            'recursos' =>  $request->input('recursos'),
            'descripcion' => $request->input('descripcion'),
            'objetivos' => $request->input('resultados'),
        ]);

        return redirect()->route('misActividades');
    }

    public function obtenerActividades(Request $request)
    {
        $actividades = DB::table('actividades')
            ->where('id_categoria', $request->input('categoriaId'))
            ->get();

        return response()->json($actividades);
    }

    public function obtenerActividadesB(Request $request)
    {
        $actividades = DB::table('actividades')
            ->where('id_subcategoria', $request->input('subcategoriaId'))
            ->get();

        return response()->json($actividades);
    }

    public function obtenerSubcategorias(Request $request)
    {
        $subcateg = DB::table('subcategorias')
            ->where('categoria', $request->input('categoriaId'))
            ->get();

        return response()->json($subcateg);
    }

    public function format_time($hours,$minutes){

        $formatH = str_pad($hours, 2, '0', STR_PAD_LEFT);
        $formatM = str_pad($minutes, 2, '0', STR_PAD_LEFT);
        return $formatH . 'h' . $formatM . 'm';

    }

    //IMPRESIONES PRESTADOR

    public function create_imps()
    {
        $impresoras = DB::table('impresoras')
            ->where('estado', 1)
            ->get();

        $proy = DB::table('proyectos')->get();

        return view('prestador/registro_impresion',
            ['imps' => $impresoras,
            'proys' => $proy
        ]);
    }

    public function register_imps(Request $request)
    {

        $tiempo = $this->format_time($request->input('horas'), $request->input('minutos'));

        DB::table('seguimiento_impresiones')->insert([['id_Prestador' =>Auth::user()->id, 
        'id_Impresora' => $request->input('imp_id'), 'id_Proyecto' =>$request->input('proyect'), 
        'nombre_modelo_stl' => $request->input('model'), 'color' => $request->input('color'), 
        'piezas' => $request->input('pieces'), 'peso' => $request->input('weight'), 'tiempo_impresion' => $tiempo]]);

        $actual = DB::table('seguimiento_impresiones')
            ->where('id_Impresora', $request->input('imp_id'))
            ->orderByDesc('fecha')
            ->limit(1)
            ->value('fecha');

        DB::table('impresoras')
            ->where('id', $request->input('imp_id'))
            ->update(['ultimo_uso' => $actual]);

        return redirect()->route('show_imps');
    }

    public function show_imps()
    {
        $data = DB::table('ver_impresiones')
            ->where('id_Prestador', Auth::user()->id)
            ->orderByDesc('fecha')
            ->get();

        return view('prestador/mostrar_mis_impresiones', ['impresiones' => json_encode($data)]);

    }

    public function show_all_imps()
    {
        $data = DB::table('ver_impresiones')
            ->orderByDesc('fecha')
            ->where('users.area', Auth::user()->area)
            ->join('users', 'users.id', '=', 'ver_impresiones.id_prestador')
            ->select(DB::raw("CONCAT(users.name, ' ', users.apellido) AS prestador"), 'ver_impresiones.*')
            ->get();

        return view('prestador/mostrar_impresiones', ['impresiones' => json_encode($data)]);

    }

    public function printstate($id, $state) {

        DB::table('seguimiento_impresiones')
            ->where('id', $id)
            ->update(['estado' => $state]);

        return response()->json(['message' => 'Activado exitosamente' . $id]);
    }

    public function detail_prints($id, $value) {

        $sql = DB::table('seguimiento_impresiones')
            ->where('id', $id)
            ->update(['observaciones' => $value]);
        return response()->json(['message' => $sql]);
    }

    //CALENDARIO PRESTADOR

    public function horario()
    {   

        $festivos = DB::table('eventos')
            ->where('sede', Auth::user()->sede)
            ->where('area', Auth::user()->area)
            ->orWhere('area', 0)
            ->get();

        $asists = DB::table('registros_checkin')
            ->where('idusuario', Auth::user()->id)
            ->pluck('fecha');
        $asistencias = [];
        
        foreach ($asists as &$asist) {
            $fechaObjeto = DateTime::createFromFormat('d/m/Y', $asist);
            $asistenciaFormateada = $fechaObjeto->format('Y-m-d');
            $asistencias[] = $asistenciaFormateada;
        }

        foreach($festivos as $festivo){

            $fechaObjeto = DateTime::createFromFormat('Y-m-d H:i:s', $festivo->inicio);
            $festivo->inicio = $fechaObjeto->format('Y-m-d');

            $fechaObjeto = DateTime::createFromFormat('Y-m-d H:i:s', $festivo->final);
            $festivo->final = $fechaObjeto->format('Y-m-d');
        }

        return view('/prestador/horario_prestador', compact('asistencias', 'festivos'));
    }

    //REPORTES

    public function show_reportes(){
        $user_id = Auth::user()->id;
        $reportes = DB::select("Select * from reportes_s_s where id_prestador = $user_id");
        
        $orden = (count(DB::select("Select id from reportes_s_s where id_prestador=$user_id and tipo = 'Orden de pago'"))==0)? true : false;
        $imss = (count(DB::select("Select id from reportes_s_s where id_prestador=$user_id and tipo = 'Constancia IMSS'"))==0)? true : false;
        $oficio = (count(DB::select("Select id from reportes_s_s where id_prestador=$user_id and tipo = 'Oficio de comision'"))==0)? true : false;

        $reporte1 = (count(DB::select("Select id from reportes_s_s where id_prestador=$user_id and tipo = 'Reporte parcial 1'"))==0)? true : false;
        $reporte2 = (count(DB::select("Select id from reportes_s_s where id_prestador=$user_id and tipo = 'Reporte parcial 2'"))==0)? true : false;
        $reporte3 = (count(DB::select("Select id from reportes_s_s where id_prestador=$user_id and tipo = 'Reporte parcial 3'"))==0)? true : false;
        $final = (count(DB::select("Select id from reportes_s_s where id_prestador=$user_id and tipo = 'Reporte final'"))==0)? true : false;
        $finalDep = (count(DB::select("Select id from reportes_s_s where id_prestador=$user_id and tipo = 'Reporte final dependencia'"))==0)? true : false;
        $carta = (count(DB::select("Select id from reportes_s_s where id_prestador=$user_id and tipo = 'Carta recomendacion'"))==0)? true : false;
        return view('prestador.reportes_parciales',
        compact('orden','imss','oficio','reporte1',
        'reporte2','reporte3','final','finalDep','carta','reportes'));
    }

    public function subir_reportes_parciales(Request $request){
        $request->validate([
            'reporte_parcial' => 'required|mimes:pdf|max:4096', //El archivo debe ser de tipo imagen y tener un tamaño máximo de MB
            'tipo_reporte'  => 'required',
        ], [
            'reporte_parcial.max' => 'El archivo debe pesar menos de 4MB',
            'reporte_parcial.required'=> 'El campo reporte es obligatorio',
            'tipo_reporte.required'=> 'El campo tipo es obligatorio'
        ]);

        
        // Obtener el usuario autenticado
        $user_id = Auth::user()->id;
        $tipo_reporte = $request->tipo_reporte; 

        // Almacenar el archivo
        $reporte_path = $request->file('reporte_parcial')->store('public/reportes_parciales/');

        $nombre_archivo = basename($reporte_path);
        $insertar= DB::table('reportes_s_s')->insert(['id_prestador' => $user_id, 'nombre_reporte' => $nombre_archivo, 'tipo'=>$tipo_reporte, 'fecha_subida' => date("Y/m/d")]);

        return redirect()->route('parciales')->with('success', 'Archivo subido con éxito');
    }

    public function eliminar_reportes_parciales($id){
        // Obtén el nombre del archivo de la base de datos
        $archivo = DB::select("Select nombre_reporte from reportes_s_s where id=$id");
        // Verifica si el archivo existe antes de intentar eliminarlo
        $file_path = storage_path('app/public/reportes_parciales/'.$archivo[0]->nombre_reporte);
        if (file_exists($file_path)) {
            DB::table('reportes_s_s')->where('id', $id)->delete();
            unlink($file_path);
        }

        return redirect()->route('parciales')->with('warning', 'Archivo y registro eliminados con éxito');
    }

    public function descargar_reporte($nombreArchivo){
        $rutaArchivo = storage_path('app/public/reportes_parciales/' . $nombreArchivo);
        return response()->download($rutaArchivo);
    }

    public function visualizar_reporte($nombreArchivo){
        $rutaArchivo = storage_path('app/public/reportes_parciales/' . $nombreArchivo);
        // Verificar si el archivo existe
            // Haz lo que necesites con el contenido del archivo
            header('content-type: application/pdf');
            readfile($rutaArchivo);
    }

    //PERFIL DEL USUARIO

    public function perfil()
    {
        $user = Auth::user();

        $sede = DB::table('sedes')
            ->select('nombre_sede', 'id_sede')
            ->where('sedes.id_sede', $user->sede) 
            ->first();

        $todasMedallasUsuario = DB::table('niveles')
                ->join('medallas', 'niveles.nivel', '=', 'medallas.nivel')
                ->select('medallas.ruta', 'medallas.nivel', 'medallas.descripcion')
                ->where('niveles.experiencia', '<=', $user->experiencia ) 
                ->orderBy('niveles.experiencia_acumulada')
                ->get();

        $ultimoElemento = $todasMedallasUsuario->last();
        $nivel_str = strval($ultimoElemento->nivel);
        $medalla = $ultimoElemento->ruta;
        $descripcion_medalla = $ultimoElemento->descripcion;

        return view('prestador.prestador_perfil', compact('user', 'sede', 'nivel_str', 'medalla', 'descripcion_medalla', 'todasMedallasUsuario'));
    }

    public function cambiarImagenPerfil(Request $request)
    {
        $request->validate([
            'imagen_perfil' => 'required|image|max:4096', // la imagen debe ser de tipo imagen y tener un tamaño máximo de MB
        ], [
            'imagen_perfil.max' => 'La imagen debe pesar menos de 4MB',
        ]);

        $user = Auth::user();

        // Eliminar la imagen del usuario si es que ya tenia
        if ($user->imagen_perfil) {
            // $image_path = public_path('storage/imagen/imagen/' . $user->imagen_perfil);
            $image_path = storage_path('app/public/userImg/'.$user->imagen_perfil);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $imagen_path = $request->file('imagen_perfil')->store('public/userImg/');
        $nombre_archivo = basename($imagen_path);
        $user->imagen_perfil =  $nombre_archivo;

        $user->save();

        return redirect()->route('perfil')->with('success', 'Imagen cambiada correctamente');
    }

    //GAMIFICACION

    public function prestador_level(){
        $actualLevel = DB::table('user_level')
            ->where('id',  Auth::user()->id) 
            ->join('medallas', 'max_nivel', '=', 'medallas.nivel')  
            ->select('max_nivel', 'medallas.ruta', 'medallas.descripcion', 'medallas.ruta_n')
            ->first();

        return $actualLevel;
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

    public function leaderboard_area(){

        $area = Auth::user()->area;
        $sede = Auth::user()->sede;

        $leaderBoard = $this->consultarLeaderboard('lb_at', $area, 'area',25);
        $leaderBoardW = $this->consultarLeaderboard('lb_w', $area, 'area',25);
        $leaderBoardM = $this->consultarLeaderboard('lb_m', $area, 'area',25);
        $leaderBoardSede = $this->consultarLeaderboard('lb_at', $sede, 'sede',25);
        $leaderBoardWSede = $this->consultarLeaderboard('lb_w', $sede, 'sede',25);
        $leaderBoardMSede = $this->consultarLeaderboard('lb_m', $sede, 'sede',25);

        return view('prestador/prestador_leaderboard', compact(
            'leaderBoard', 'leaderBoardW', 'leaderBoardM', 
            'leaderBoardSede', 'leaderBoardWSede', 'leaderBoardMSede'
        ));
    }

    public function level_progress()
    {

        if(Auth::user()->experiencia >= 2000){
            $niveles = DB::table('niveles')
                ->join('medallas', 'niveles.nivel', '=', 'medallas.nivel')
                ->select('niveles.nivel', 'medallas.ruta', 'medallas.descripcion', 'niveles.experiencia')
                ->where('niveles.experiencia_acumulada', '>=', 1835)
                ->orderBy('niveles.experiencia_acumulada')
                ->limit(2)
                ->get();

            $percent = 100;

        }else{
            $nivel = DB::table('niveles')
                ->join('medallas', 'niveles.nivel', '=', 'medallas.nivel')
                ->join('ruta_niveles', 'niveles.nivel', '=', 'ruta_niveles.nivel')
                ->select('niveles.nivel', 'medallas.ruta', 'medallas.descripcion', 'ruta_niveles.exp', 'niveles.experiencia' )
                ->where('niveles.experiencia_acumulada', '>=', Auth::user()->experiencia)
                ->orderBy('niveles.experiencia_acumulada')
                ->limit(2)
                ->get();

            $full = $nivel[1]->experiencia - $nivel[0]->experiencia;
            $adv = Auth::user()->experiencia - $nivel[0]->experiencia;
            $percent = number_format(($adv * 100) / $full, 2);
        }

        return view('prestador/prestador_levels',compact('nivel','percent'));
    }

    //TERRITORIOS DESCONOCIDOS 
    /*

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
        return view('prestador/registro_horas');
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
    */
}