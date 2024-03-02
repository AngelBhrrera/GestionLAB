<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Visitas;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Hash;

/*
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\cita_cliente;
use App\Models\premio;

use Illuminate\Support\Facades\Log;
use ProyectosPrestadores;
use PhpParser\Node\Stmt\Switch_;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\MailController;*/

class AdminController extends Controller
{

    //ADMIN HOME

    public function firmas(){
        
        $sql = DB::table('registros_checkin as r')
            ->select('r.*', 'u.codigo')
            ->join('users as u', 'r.idusuario', '=', 'u.id')
            ->where('u.area', Auth::user()->area)
            ->orderBy('fecha_actual', 'desc')
            ->get();


        if(Auth::user()->tipo == "coordinador"){
            return view("admin.asistencias_encargado", ['datos' => json_encode($sql)]);
        }else{
            return view("admin.asistencias_admin", ['datos' => json_encode($sql)]);
        }
    }    

    public function checkinstate($id, $state) {
            DB::table('registros_checkin')
                ->where('id', $id)
                ->update(['estado' => $state]);
    
        return response()->json(['message' => 'Activado exitosamente' . $id]);
    }

    public function modifHoras($id, $hrs) {
        DB::table('registros_checkin')
            ->where('id', $id)
            ->update(['horas' => $hrs]);

    return response()->json(['message' => 'Activado exitosamente' . $id]);
}

    //ADMINSITRADOR DE PRESTADORES / VOLUNTARIOS / PRACTICANTES

    public function registro()
    {
        $users = [
            ['id' => 'ext', 'value' => 'externo', 'name' => 'Visitante Externo'],
            ['id' => 'clientM', 'value' => 'maestro', 'name' => 'Visitante Maestro'],
            ['id' => 'clientA', 'value' => 'alumno', 'name' => 'Visitante Alumno'],
            ['id' => 'RBvoluntario', 'value' => 'voluntario', 'name' => 'Voluntario'],
            ['id' => 'RBpracticante', 'value' => 'practicante', 'name' => 'Practicas Profesionales'],
            ['id' => 'RBprestador', 'value' => 'prestador', 'name' => 'Prestador Servicio Social'],
            ['id' => 'RBencargado', 'value' => 'coordinador', 'name' => 'Coordinador']
        ];

        $sedes = DB::table('sedes');
        $areas = DB::table('areas');

        if(in_array(Auth::user()->tipo, ['coordinador', 'jefe area'])) {
            $sedes->where('id_sede',  Auth::user()->sede);       
            $areas->where('id',  Auth::user()->area);
        }else if (Auth::user()->tipo == 'jefe sede'){
            $sedes->where('id_sede',  Auth::user()->sede);
            $users[] = ['id' => "RBadmin", 'value' => 'jefe area', 'name' => 'Jefe de area'];
        }else if (Auth::user()->tipo == 'Superadmin'){
            $users[] = ['id' => "RBadmin", 'value' => 'jefe area', 'name' => 'Jefe de area'];
            $users[] = ['id' => "RBadminsede", 'value' => 'jefe sede', 'name' => 'Jefe de Sede'];
        }

        $sedes = $sedes->get();
        $areas = $areas->get();

        
        return view('auth/registerAdmin', compact('sedes','areas','users'));
    }

    public function checkin()
    {
        return view('/auth/checkin', ['ruta' => 'registrar']);
    }

    public function general()
    {
        $data = DB::table('users')
            ->select('users.id','users.name', 'users.apellido', 'users.correo', 'users.codigo', 'users.tipo', 'users.telefono', 'areas.nombre_area')
            ->whereNotIn('users.tipo', ['Superadmin'])
            ->join('areas', 'users.area', '=', 'areas.id');

        if (auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area') {
            $data->where('users.area', auth()->user()->area);
            $data = $data->get();
            return view('admin/general_users', ['datos' => json_encode($data)]);
        } else if (auth()->user()->tipo == 'jefe sede') {
            $data->where('users.sede', auth()->user()->sede);
        }

        $data = $data->get();

        return view('admin/admin_general_users', ['datos' => json_encode($data)]);
    }

    public function administradores()
    {  
        $data = DB::table('solo_admins');

        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $n_Area = DB::table('areas')
                ->where('id', auth()->user()->area)
                ->value('nombre_area');
            $data->where('solo_admins.area',$n_Area);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $n_Sede = DB::table('sedes')
                ->where('id_sede', auth()->user()->sede)
                ->value('nombre_sede');
            $data->where('solo_admins.sede',$n_Sede);
        }

        $data = $data->get();

        return view('admin/admins', ['datos' => json_encode($data)]);
    }

    public function clientes()
    {
        $data = DB::table('solo_clientes')
        ->get();
        return view('admin/lista_clientes', ['datos' => json_encode($data)]);
    }

    public function prestadores()
    {
        $data = DB::table('solo_prestadores');
        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $data->where('id_area', Auth::user()->area);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $data->where('id_sede', Auth::user()->sede);
        }
        $data = $data->get();
        return view('admin/activos', ['datos' => json_encode($data)]);
    }

    public function prestadores_pendientes()
    {
        $data = DB::table('prestadores_pendientes');
        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $data->where('area', Auth::user()->area);
        }else{
            $data->where('sede',  Auth::user()->sede);
        }
        $data = $data->get();

        return view('admin/prestadoresPendientes', ['datos' => json_encode($data)]);
    }

    public function prestadores_terminados()
    {
        $data = DB::table('prestadores_servicio_concluido');
            
        if(Auth::user()->tipo == 'coordinador' )
        {
            $data = $data->where('sede', Auth::user()->sede)->get();
            return view('admin/servicioConcluido', ['datos' => json_encode($data)]);
        }else{
            $data = $data->get();
            return view('admin/administrar_servicioConcluido', ['datos' => json_encode($data)]);
        }
    }

    public function prestadores_liberados()
    {
        $data = DB::table('prestadores_servicio_liberado');
        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $data->where('area', Auth::user()->area);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $data->where('sede',  Auth::user()->sede);
        }
        $data = $data->get();
        return view('admin/servicioLiberado', ['datos' => json_encode($data)]);
    }

    public function prestadores_inactivos()
    {
        $data = DB::table('prestadores_inactivos');
        if( auth()->user()->tipo == 'coordinador'){
            $data->where('area', Auth::user()->area);
            $data = $data->get();
            return view('admin/prestadoresInactivos', ['datos' => json_encode($data)]);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $data->where('sede',  Auth::user()->sede);
        }
        $data = $data->get();
        return view('admin/administrar_prestadoresInactivos', ['datos' => json_encode($data)]);
    }

    //MODIFICACIONES DE USUARIO

    public function activar($id) {

        $typeMappings = [
            'prestadorp' => 'prestador',
            'prestador_inactivo' => 'prestador',
            'voluntariop' => 'voluntario',
            'voluntario_inactivo' => 'voluntario',
            'practicantep' => 'practicante',
            'practicante_inactivo' => 'practicante',
        ];

        $type =DB::table('users')
            ->where('id', $id)
            ->value('tipo');
        
        $newType = $typeMappings[$type] ?? null;
        
        if ($newType) {
            User::where('id', $id)
                ->update(['tipo' => $newType]);
        
            return response()->json(['message' => 'Activado exitosamente']);
        } else {
            return response()->json(['message' => 'No se encontró un nuevo tipo para actualizar']);
        }
    }

    public function desactivar($id) {

        $typeMappings = [
            'prestador' => 'prestador_inactivo',
            'coordinador' => 'prestador_inactivo',
            'voluntario' => 'voluntario_inactivo',
            'practicante' => 'practicante_inactivo',
        ];

        $type = DB::table('users')
            ->where('id', $id)
            ->value('tipo');
        $newType = $typeMappings[$type] ?? null;
        if($type == 'coordinador' && auth()->user()->tipo != 'coordinador'){
            User::where('id', $id)
                ->update(['tipo' => $newType]);
            return response()->json(['message' => 'Desactivado exitosamente']);
        }
        User::where('id', $id)
            ->update(['tipo' => $newType]);
        
        return response()->json(['message' => 'Desactivado exitosamente']);
    }

    public function eliminar($id) {
        
        User::where('id', $id)
            ->delete();
    
        return response()->json(['message' => 'Prestador eliminado']);
    }

    public function liberar($id) {

        User::where('id', $id)
            ->update(['fecha_salida' => Carbon::now()]);

        return response()->json(['message' => 'Liberado exitosamente']);
    }

    public function cambiar_horario($id, $horario){

        $horarioMappings = [
            'Matutino' => 'turnoMatutino',
            'Mediodia' => 'turnoMediodia',
            'Vespertino' => 'turnoVespertino',
            'Tiempo Completo' => 'turnoTiempoCompleto',
            'Sabatino' => 'turnoSabatino',
        ];
        
        $n_Turno = $horarioMappings[$horario] ?? null;

        $area = DB::table('users')
        ->where('id', $id)
        ->value('area');
       
        User::where('id', $id)
            ->update([
                'horario' => DB::table('areas')
                ->where('id', $area)
                ->value($n_Turno) == 1 ? $horario : DB::raw('horario')]);

            return response()->json(['message' => 'Activado exitosamente']);
    }

    public function cambiar_tipo($id, $value){

        User::where('id', $id)
            ->update(['tipo' => $value]);

        return response()->json(['message' => 'Modificado exitosamente']);
    }

    // ACTIVIDADES Y PROYECTOS

    public function actstate($id, $state) {
        DB::table('actividades_prestadores')
            ->where('id', $id)
            ->update(['estado' => $state]);

        if($state == 'Aprobada'){
            $this->approveAct($id);
        }

        return response()->json(['message' => 'Actividad modificada exitosamente' . $id]);
    }

    public function approveAct($id){

        $expIsNull = DB::table('actividades_prestadores')
            ->where('id', $id)
            ->whereNull('exp')
            ->exists();

        if($expIsNull){

            $TR = DB::table('actividades_prestadores')
            ->where('id', $id)
            ->value('Tiempo_Invertido');
            
            DB::table('actividades_prestadores')
                ->where('id', $id)
            ->update(['Tiempo_Real' => $TR]);

            $this->expUser($id);
        }

        return 0;

    }

    public function expUser($id){

        $exp = DB::table('exp_calculator')
            ->where('id', $id)
            ->value('exp_obtenida');

        DB::table('actividades_prestadores')
            ->where('id', $id)
            ->update(['exp' => $exp]);

        $idP = DB::table('actividades_prestadores')
        ->where('id', $id)
        ->value('id_prestador');

        $userXP = DB::table('users')
        ->where('id', $idP)
        ->value('experiencia');

        $userXP = $userXP + $exp;

        DB::table('users')
        ->where('id', $idP)
        ->update(['experiencia' => $userXP]);

        return 0;
    }

    public function actividades(){

        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $data = DB::table('seguimiento_actividades')
            ->whereIn('id_proyecto', function ($query) {
                $query->select('id')
                    ->from('proyectos')
                    ->where('id_area', auth()->user()->area);
            })
            ->get();
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $data = DB::table('seguimiento_actividades')
            ->whereIn('id_proyecto', function ($query) {
                $query->select('id')
                      ->from('proyectos')
                      ->whereIn('id_area', function ($subquery) {
                          $subquery->select('id_sede')
                                   ->from('areas')
                                   ->where('id_sede', auth()->user()->sede);
                      });
            })
            ->get();
        }else{
            $data = DB::table('seguimiento_actividades')
            ->get();
        }
        return view( 'admin/ver_todasActividades', [ 'data' =>json_encode($data)]);
    }

    public function reviewActs(){
        $data = DB::table('seguimiento_actividades')
        ->whereIn('estado', ['En revision', 'Error']);

        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $data->whereIn('id_proyecto', function ($query) {
                $query->select('id')
                    ->from('proyectos')
                    ->where('id_area', auth()->user()->area);
            });
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $data->whereIn('id_proyecto', function ($query) {
                $query->select('id')
                      ->from('proyectos')
                      ->whereIn('id_area', function ($subquery) {
                          $subquery->select('id_sede')
                                   ->from('areas')
                                   ->where('id_sede', auth()->user()->sede);
                      });
            });
        }
        $data = $data->get();
        
        return view( 'admin/calificar_actividades', [ 'data' =>json_encode($data)]);
    }
    
    public function create_act()
    {
        $prestadores = DB::table('solo_prestadores');
        $categorias = DB::table('categorias')->get();
        $subcategorias = DB::table('subcategorias')->get();
        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $prestadores->where('id_area', auth()->user()->area)
                ->where('horario', auth()->user()->horario);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $prestadores->where('id_sede', auth()->user()->sede)
                ->where('horario', auth()->user()->horario);
        }
        $prestadores = $prestadores->get();

        return view('/admin/registro_actividades',
                ['prestadores' => $prestadores,
                'categorias' => $categorias,
                'subcategorias' => $subcategorias]);
    }
    
    public function make_act(Request $request) {

        $request->validate([
            'nombre' => 'string|max:255',
            'tipo' => 'integer',
            'recursos' => 'string', 
            'descripcion' => 'string|max:500',
            'objetivos' => 'string', 
            'horas' => 'integer|min:1|max:60', 
            'minutos' => 'integer|min:1|max:60',
        ]);

        $subcategoria = $request->input('tipo_subcategoria');
        if($subcategoria == '')
            $subcategoria = null;
        $horas = $request->input('horas')*60;
        $minutos = $request->input('minutos');
        $tec = $horas + $minutos;
    
        DB::table('actividades')->insert([
    
            'titulo' =>$request->input('nombre'),
            'id_categoria' =>  $request->input('tipo_categoria'),
            'id_subcategoria' => $subcategoria,
            'tipo' => $request->input('tipo_actividad'),
            'recursos' => $request->input('recursos'),
            'descripcion' =>$request->input('descripcion'),
            'objetivos' => $request->input('resultados'),
            'TEC' => $tec,]);
    
        return redirect(route('admin.asign_act'));
    }

    public function asign_act(){

        $prestadores = DB::table('solo_prestadores');
    
        if( auth()->user()->tipo == 'coordinador'){
            $prestadores->where('id_area', auth()->user()->area)
                ->where('horario', auth()->user()->horario);
        }else if(auth()->user()->tipo == 'jefe area'){
            $prestadores->where('id_area', auth()->user()->area);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $prestadores->where('id_sede', auth()->user()->sede);
        }
            
        $categorias = DB::table('categorias')->get();
        $actividades = DB::table('actividades')
            ->whereNotNull('TEC')
            ->get();
        $proyectos = DB::table('proyectos')->get();
        $prestadores = $prestadores->get();
    
        return view( 'admin/asignar_actividades', compact('prestadores', 'categorias', 'actividades', 'proyectos'));
    }

    public function asign(Request $request){

        $request->validate([
            'proyecto' => 'integer',
            'tipo_actividad' => 'integer',
            'prestadores_seleccionados' => 'required|array',
            'prestadores_seleccionados.*' => 'integer',
        ]);

        $generic = DB::table('proyectos')
            ->where('particular', 0)
            ->exists();

        $prestadoresSeleccionados = $request->input('prestadores_seleccionados');
        $tamañoArreglo = count($prestadoresSeleccionados);

        if(!$generic){
            for ($i = 0; $i < $tamañoArreglo; $i++) {
                $idp = $prestadoresSeleccionados[$i];
                $check = DB::table('proyectos_prestadores')
                    ->where('id_prestador', $idp)
                    ->where('id_proyecto', $request->input('proyecto'))
                    ->exists();
                if($check){
                    DB::table('actividades_prestadores')->insert([
                        'id_prestador' => $idp,
                        'id_actividad' => $request->input('tipo_actividad'),
                        'id_proyecto' => $request->input('proyecto')]);
                }else{
                    return redirect(route('admin.asign_act'))->with('error', 'Error'); 
                }
            }

            return redirect(route('admin.asign_act'))->with('success', 'Creada correctamente');

        }else{
            for ($i = 0; $i < $tamañoArreglo; $i++) {
                $idp = $prestadoresSeleccionados[$i];
                    DB::table('actividades_prestadores')->insert([
                        'id_prestador' => $idp,
                        'id_actividad' => $request->input('tipo_actividad'),
                        'id_proyecto' => $request->input('proyecto')]);
            }
            return redirect(route('admin.asign_act'))->with('success', 'Creada correctamente');
        }
    }

    public function asign2(Request $request){

        $request->validate([
            'proyecto' => 'integer',
        ]);

        $modules = array();


        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'module-') === 0) {
                $moduleNumber = substr($key, strlen('module-'));
                $modules[$moduleNumber] = $value;
            }
        }

        $tamañoArreglo = count($modules);
        for ($i = 0; $i < $tamañoArreglo; $i++) {
            $ida = $modules[$i];

            DB::table('actividades_prestadores')->insert([
                'id_actividad' => $ida,
                'id_proyecto' => $request->input('proyecto')]);
        }

        return redirect(route('admin.create_proy'))->with('success', 'Asignaciones realizadas con exito');
    }

    //PROYECTOS

    public function create_proy() {

        $prestadores = DB::table('solo_prestadores');
        $areas = DB::table('areas')
            ->select('id', 'nombre_area');

        if( auth()->user()->tipo == 'coordinador'){
            $prestadores->where('id_area', auth()->user()->area)
                ->where('horario', auth()->user()->horario)
                ->where('tipo', '!=', 'coordinador');
            $areas->where('id', auth()->user()->area);
        }else if(auth()->user()->tipo == 'jefe area'){
            $prestadores->where('id_area', auth()->user()->area);
            $areas->where('id', auth()->user()->area);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $prestadores->where('id_sede', auth()->user()->sede);    
            $areas->where('id_sede', auth()->user()->sede);
        }
        $areas = $areas->get();
        $prestadores= $prestadores->get();
        return view('/admin/registro_proyectos', compact('prestadores', 'areas'));
    }

    
    public function proy_acts() {
 
        $categorias = DB::table('categorias')->get();
        $proyectos = DB::table('proyectos')->get();

        return view('/admin/asignar_actividad_proyecto', compact( 'categorias', 'proyectos'));
    }

    public function make_proy(Request $request){

        $request->validate([
            'particular' => 'integer',
            'area' => 'integer',
            'prestadores_seleccionados' => 'required|array',
            'prestadores_seleccionados.*' => 'integer',
        ]);
            
        $boolp = boolval($request->input('particular'));
        $idpy = DB::table('proyectos')->insertGetId([
            'titulo' => $request->t_nombre,
            'id_area' => $request->input('area'),
            'particular' => $boolp,
        ]);

        $prestadoresSeleccionados = $request->input('prestadores_seleccionados');
        if ($prestadoresSeleccionados != null){
            $tamañoArreglo = count($prestadoresSeleccionados);

                for ($i = 0; $i < $tamañoArreglo; $i++) {
                    $idp = $prestadoresSeleccionados[$i];
                    DB::table('proyectos_prestadores')->insert([
                        'id_prestador' => $idp,
                        'id_proyecto' => $idpy,]);
                }
        }

        return redirect(route('admin.create_proy'))->with('success', 'Creada correctamente');
    }

    public function view_proys(){
        $tabla_proy = DB::table('seguimiento_proyecto')
        ->get();
        
        return view('admin.ver_proyectos', ['tabla_proy' => $tabla_proy]);
    }
    
    public function view_details_proy($id){

        $proyecto = DB::table('proyectos')
            ->select('titulo')->where('id',$id)
            ->get();
        $prestadores = DB::table('proyectos_prestadores')
            ->select('id_prestador', 'name', 'apellido', 'correo', 'telefono')
            ->where('id_proyecto', $id)
            ->join('users', 'id_prestador','=','users.id')
            ->get();
        $actividades = DB::table('seguimiento_actividades')
            ->select('actividad_id','actividad', 'estado', 'prestador')
            ->where('id_proyecto', $id)
            ->get();
        
        return view('admin.ver_detalles_proyecto', compact('proyecto','prestadores', 'actividades'));
    }

    public function view_details_act($id)
    {

        $detalles = DB::table('actividades')
            ->select('actividades.*', 'categorias.nombre AS nombre_categoria', 'subcategorias.nombre AS nombre_subcategoria')
            ->join('categorias', 'actividades.id_categoria', '=', 'categorias.id')
            ->leftJoin('subcategorias', 'actividades.id_subcategoria', '=', 'subcategorias.id') 
            ->where('actividades.id', $id)
            ->first();

        return view('/admin/admin_detalles_actividad', [ 'detalle' => $detalles]);
    }

    public function obtenerPrestadores(Request $request)
    {
        $prestadores = DB::table('solo_prestadores')
            ->select('solo_prestadores.id','solo_prestadores.name', 'solo_prestadores.apellido')
            ->join('proyectos_prestadores', 'solo_prestadores.id', '=', 'proyectos_prestadores.id_prestador')
            ->where('proyectos_prestadores.id_proyecto', $request->input('proyectoId'))
            ->get();

        return response()->json($prestadores);
    }

    //IMPRESORAS

    public function watch_prints()
    {
        $data = DB::table('ver_impresiones')
            ->join('users', 'ver_impresiones.id_Prestador', '=', 'users.id')
            ->where('sede', auth()->user()->sede)
            ->get();
        return view( 'admin/mostrar_impresiones', [ 'impresiones' =>json_encode($data)]);
    }

    public function control_print()
    {
        $data = DB::table('impresoras')
        ->where('id_area', auth()->user()->area)
        ->get();

        return view('admin/registro_impresora',
            [ 'impresiones' =>json_encode($data)
        ]);
    }

    public function activate_print($id) {

        DB::table('impresoras')
            ->where('id', $id)
            ->update(['estado' => DB::raw('CASE WHEN estado = 1 THEN 0 ELSE 1 END')]);

        return response()->json(['message' => 'Estado de la impresora cambiado']);
    }

    public function detail_prints($id, $value) {

        DB::table('seguimiento_impresiones')
            ->where('id', $id)
            ->update(['observaciones' => $value]);
        return response()->json(['message' => 'Detalles agregados']);
    }

    public function printstate($id, $state) {

        DB::table('seguimiento_impresiones')
            ->where('id', $id)
            ->update(['estado' => $state]);

        return response()->json(['message' => 'Activado exitosamente' . $id]);
    }

    public function make_print(Request $request)
    {
        $request->validate([
            'nombre' => 'string|max:255',
            'nombre' => 'string|max:255',
            'nombre' => 'string|max:255',
        ]);


        DB::table('impresoras')->insert([
            'nombre' => $request->input('nombre'),
            'marca' => $request->input('mark'),
            'tipo' =>$request->input('tipo'),
            'id_area' =>auth()->user()->area
        ]);

        return redirect()->back();
    }

    //CATEGORIAS Y SUBCATEGORIAS

    public function categorias(){

        $categ = DB::table('categorias')
            ->get();

        $subcateg = DB::table('subcategorias')
            ->select('subcategorias.*', 'categorias.nombre AS categoria')
            ->join('categorias', 'subcategorias.categoria', '=', 'categorias.id')
            ->get();
        return view("admin.categorias", ['categoria'=>$categ, 'tabla_subcategorias' => json_encode($subcateg) ]);
    }

    public function nuevaCateg(Request $request){

        $request->validate([
            'nombreCateg' => 'required|max:255',
        ]);

        $buscarCat = DB::Select("Select nombre from categorias where nombre = '$request->nombreCateg'");
        if (count($buscarCat)==0){
            $nombre=$request->input("nombreCateg");
            DB::insert("INSERT INTO categorias (nombre) Values('$nombre')");
            return redirect(route('admin.categorias'))->with('success', 'Creada correctamente');
        }else{
            return redirect(route('admin.categorias'))->with('warning', "Ya existe una categoria con ese nombre");
        }

    }

    public function nuevaSubcateg(Request $request){

        $request->validate([
            'categ' => 'required',
            'nombreSubc' => 'required|max:255',
        ]);

        $categ=$request->input("categ");
        $subcateg=$request->input("nombreSubc");
        $sql = DB::insert("INSERT INTO subcategorias (nombre, categoria) Values('$subcateg', '$categ')");
        if ( $sql == 1){
            return redirect(route('admin.categorias'))->with('success', 'Creada correctamente');
        }else{
            return redirect(route('admin.categorias'))->with('warning', "No se puedo crear la subcategoria");
        }
    
    }

   // CAMBIO DE ROL PARA coordinador

    public function cambiarRol()
    {
        if (Auth::user()->tipo == "coordinador") {
                return redirect('/');
            
        }
    }

    //SISTEMA DE REPORTES

    public function ver_reportes_parciales(){

        $prestadores = DB::table('solo_prestadores')
            ->select(DB::raw("CONCAT(name, ' ', apellido) AS prestador"), 'codigo', 'id')
            ->where('id_sede', Auth::user()->sede);
        
        if(Auth::user()->tipo == "jefe area"){
            $prestadores->where('id_area', Auth::user()->area);
        }

        $prestadores = $prestadores->get();
        
        return view('admin.ver_reportes_parciales', compact('prestadores'));
    }

    public function busqueda_reportes_parciales(Request $request){

        $request->validate([
            'busqueda' => 'string|max:9',
        ]);

        if ($request->busqueda==""){
            return redirect()->route('admin.reportes_parciales')->with(['warning'=>'Debes ingresar un código']);
        }

        return redirect()->route('admin.resultados_busqueda', ['codigo'=>$request->busqueda]);   
    }

    public function resultados_busqueda($codigo){
        $prestadores = DB::table('users')
            ->select(DB::raw("CONCAT(name, ' ', apellido) AS prestador"), 'codigo', 'id')
            ->where('sede', Auth::user()->sede);
        if(Auth::user()->tipo == "jefe area"){
                $prestadores->where('area', Auth::user()->area);
            }
        $id_prestador = DB::table('users')
            ->where('codigo', $codigo)
            ->value('id');

        if(!$id_prestador) {
            return redirect()->route('admin.reportes_parciales')->with('warning', 'El prestador no existe');
        }
        $reportes = DB::table('reportes_s_s')
            ->where('id_prestador', $id_prestador)
            ->get();
        $prestadores = $prestadores->get();
        if(count($reportes) != 0){
            $success = "Registro encontrado";
            return view('admin.resultados_busqueda', compact('reportes', 'codigo','prestadores', 'success'));
        }else{
            $warning = "No se encontraron registros del prestador";
            return view('admin.resultados_busqueda', compact('reportes', 'codigo', 'prestadores', 'warning'));  
        } 
    }

    public function autorizar_denegar_reportes($modo, $id){
        if($modo == "autorizar"){
            $autorizar = DB::table('reportes_s_s')->where('id', $id)->update(['estado'=> 'autorizado']);
        }else{
            $denegar= DB::table('reportes_s_s')->where('id', $id)->update(['estado'=> 'rechazado']);
        }
        return redirect()->back();
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

    //VISITAS

    public function visits()
    {
        return view('/auth/visitator', ['ruta' => 'registrar']);
    }
    
    public function watch_visits()
    {            
        $n_sede = DB::table('sedes')
            ->where('id_sede', Auth::user()->sede)
            ->value('nombre_sede');
        $data = DB::table('visitas')
            ->orderBy('id', 'DESC')
            ->get();
        return view('/admin/ver_visitas', ['datos' => json_encode($data), 'sede' => $n_sede]);
    }
    
    public function motivo($id, $value)
    {
        $sql = DB::table('visitas')
            ->where('id', $id)
            ->update(['motivo' => $value]);
        return response()->json(['message' => $sql]);
    }

    public function registrarVisitas(Request $request)
    {
        Visitas::create($request->all());
        return redirect('/')->with('success', 'Creado correctamente');
    }

    public function salidaVisita(Request $request)
    {
        $id = $request->input('id');
        $vmodificar = Visitas::findOrFail($id);

        $currentDateTime = date('Y-m-d H:i:s');
        $newDateTime = date('h:i A', strtotime($currentDateTime));
        $newDateTime2 = date('Y-m-d H:i:s', strtotime($currentDateTime));

        $vmodificar->hora_salida = $newDateTime;
        $vmodificar->fecha_salida = $newDateTime2;

        $vmodificar->save();
        return redirect()->route('admin.visitas');
    }

    //CONTROL DE SEDES

    public function gestionSedes(){
        $sedes = DB::table('sedes_areas');
        $s = DB::table('sedes');
        
        if(auth()->user()->tipo != 'Superadmin'){

            $sedes->where('id_sede', '=', auth()->user()->sede);
            $s->where('id_sede', '=', auth()->user()->sede);
        }

        $sedes = $sedes->get();
        $s = $s->get();

        return view("admin.sedes", ['s'=>$s, 'tabla_sedes' => json_encode($sedes)]);
    }

    public function activate_area($id, $campo)
    {
        if (Schema::hasColumn('areas', $campo)) {
            $sql = DB::table('areas')
                ->where('id', $id)
                ->update([$campo => DB::raw('NOT '.$campo)]);
        } else if (Schema::hasColumn('modulos', $campo)){
            $sql = DB::table('modulos')
                ->where('id', $id)
                ->update([$campo => DB::raw('NOT '.$campo)]);
        }
        return response()->json(['message' => $sql]);
    }

    public function nuevaSede(Request $request){
        $request->validate([
            'nombreSede' => 'required|max:255',
        ]);
        $nombre= strtoupper($request->input('nombreSede'));
        $buscarSede = DB::Select("Select nombre_sede from sedes where nombre_sede = '$nombre'");
        if (count($buscarSede)==0){
            $nombre=$request->input("nombreSede");
            DB::insert("INSERT INTO sedes (nombre_sede) Values('$nombre')");
            return redirect(route('admin.sede'))->with('success', 'Creada correctamente');
        }else{
            return redirect(route('admin.sede'))->with('warning', "Ya existe una sede con ese nombre");
        }
    }

    public function nuevaArea(Request $request){
        $request->validate([
            'sede'=> 'required',
            'nombreArea' => 'required|max:255',
        ]);

        $nombre= strtoupper($request->input('nombreArea'));
        $idSede = $request->input('sede');

        $buscarArea = DB::table('areas')
            ->where('nombre_area', $nombre)
            ->where('id_sede', $idSede)
            ->exists(); echo $buscarArea;
        if (!$buscarArea){
            $id = DB::table('areas')->insertGetId([
                'nombre_area' => $nombre,
                'id_sede' => $idSede
            ]);
            DB::insert("INSERT INTO modulos (id) values($id)");
            return redirect(route('admin.sede'))->with('success', 'Creada correctamente');
        }else{
            return redirect(route('admin.sede'))->with('warning', "Ya existe una área con ese nombre");
        }
    }

    //CALENDARIO

    public function diasfestivos(){   

        $no_laboral = DB::table('eventos')
            ->where('sede', Auth::user()->sede)
            ->where('area', Auth::user()->area)
            ->orWhere('area', 0)
            ->orderBy('inicio')
            ->get();

        //$no_laboral = DB::select("Select * from eventos where sede = $sede and (area = $area or area = 0 ) order by inicio;");

        foreach($no_laboral as $valor){

            $fechaObjeto = DateTime::createFromFormat('Y-m-d H:i:s', $valor->inicio);
            $valor->inicio = $fechaObjeto->format('d-m-Y');

            $fechaObjeto = DateTime::createFromFormat('Y-m-d H:i:s', $valor->final);
            $valor->final = $fechaObjeto->format('d-m-Y');
        }

        return view('admin.dias_festivos',['no_laboral' =>json_encode($no_laboral)]);
    }

    public function guardarFestivos(Request $request)
    {   
        $request->validate([
            'descripcion' => 'string|max:500',
            'tipo' => 'string | max:100',
            'sede' =>  'integer',
            'area' => 'integer',
        ]);

        if($request->input('tipo')=='vacaciones'){

            DB::table('eventos')->insert(
                ['evento'=> $request->input('descripcion'),                   
                'inicio' => $request->input('vacacionesInicio'),
                'final'=> $request->input('vacacionesFin'),
                'tipo'=>$request->input('tipo'),
                'sede'=>$request->input('sede'),
                'area'=>$request->input('area')]
            );
        }else{
            DB::table('eventos')->insert(
                ['evento'=> $request->input('descripcion'),                   
                'inicio' => $request->input('diaFestivo'),
                'final'=> $request->input('diaFestivo'),
                'tipo'=>$request->input('tipo'),
                'sede'=>$request->input('sede'),
                'area'=>$request->input('area')]
            );
        }
        
        return redirect()->route('admin.diasfestivos')->with('success','Agregado correctamente');
    }

    public function editardiafestivo(Request $request)
    {   
        $request->validate([
            'id_festivo' => 'integer',
            'descripcion' => 'string|max:500',
            'tipo' => 'string | max:100',
            'sede' =>  'integer',
            'area' => 'integer',
        ]);

        $id_festivo = $request->id_festivo;
        $tipo = $request->tipo;
        $inicio = $request->inicio;
        $fin = $request->fin;
        $descripcion = $request->descripcion;

        if($tipo == 'festivo'){
            $fin = $inicio;
        }

        DB::table('eventos')
            ->where('id', $id_festivo)
            ->update(['evento'=>$descripcion, 'inicio'=>$inicio, 'final'=>$fin]);

        return redirect()->route('admin.diasfestivos')->with('success', 'Modificado correctamente');
    }

    public function eliminardiafestivo($id)
    {
        DB::table('eventos')->where('id', $id)->delete();
        return response()->json(['message' => 'Festivo eliminado']);
    }


    public function obtenerActividades(Request $request)
    {
        $request->validate([
            'categoriaId' => 'integer',
        ]);

        $actividades = DB::table('actividades')
            ->where('id_categoria', $request->input('categoriaId'))
            ->whereNotNull('TEC')
            ->get();

        return response()->json($actividades);
    }

    public function obtenerActividadesB(Request $request)
    {
        $request->validate([
            'subcategoriaId' => 'integer',
        ]);

        $actividades = DB::table('actividades')
            ->where('id_subcategoria', $request->input('subcategoriaId'))
            ->whereNotNull('TEC')
            ->get();

        return response()->json($actividades);
    }

    public function obtenerSubcategoria(Request $request)
    {
        $request->validate([
            'categoriaId' => 'integer',
        ]);

        $subcateg = DB::table('subcategorias')
            ->where('categoria', $request->input('categoriaId'))
            ->get();

        return response()->json($subcateg);
    }

    public function proposeActs(){
        $data = DB::table('actividades')
            ->whereNull('TEC')
            ->get();
        return view("admin.aprobar_actividades", compact('data'));
    }

    public function setActTEC($id){
        
        $actividad = DB::table('actividades')
            ->where('id', $id)
            ->whereNull('TEC')
            ->first();

        if(!$actividad){
            return redirect()->back()->with("Error",);
        }else{
            $categ = DB::table('categorias')
            ->where('id', $actividad->id_categoria)
            ->value('nombre');
            $subcateg = DB::table('subcategorias')
                ->where('id', $actividad->id_subcategoria)
                ->value('nombre');
            $categorias = DB::table('categorias')->get();
            return view("admin.aprobar_actividad", compact('actividad', 'categ', 'subcateg', 'categorias'));
        }
    }

    public function actTEC(Request $request){
        $request->validate([
            'nombre' => 'required |string | max:255',
            'tipo_categoria' => 'required | integer',
            'recursos' => 'required | string', 
            'descripcion' => 'required | string|max:500',
            'objetivos' => 'required | string', 
            'horas' => 'integer|min:1|max:60', 
            'minutos' => 'integer|min:1|max:60',
        ]);
        $actividad = DB::table('actividades')
            ->where('id', $request->input('id'))
            ->first();
        $subcategoria = $request->input('tipo_subcategoria');
        if($subcategoria == '')
            $subcategoria = null;
        $horas = $request->input('horas')*60;
        $minutos = $request->input('minutos');
        $tec = $horas + $minutos;

        $updates = [];
        if ($actividad->titulo != $request->input('nombre')) 
            $updates['titulo'] = $request->input('nombre');
        if ($actividad->id_categoria != $request->input('tipo_categoria')) 
            $updates['id_categoria'] = $request->input('tipo_categoria');
        if ($actividad->id_subcategoria != $subcategoria) 
            $updates['id_subcategoria'] = $subcategoria;
        if ($actividad->descripcion != $request->input('descripcion')) 
                $updates['descripcion'] = $request->input('descripcion');    
        if ($actividad->recursos != $request->input('recursos')) 
                $updates['recursos'] = $request->input('recursos');
        if ($actividad->objetivos != $request->input('resultados')) 
                $updates['objetivos'] = $request->input('resultados'); 
        if ($actividad->tipo != $request->input('tipo_actividad')) 
                $updates['tipo'] = $request->input('tipo_actividad');

        $updates['TEC'] = $tec;


        if (!empty($updates)) {
            DB::table('actividades')->where('id', $request->input('id'))->update($updates);
        }
        return redirect('/admin/A_actividades')->with('SUCCESS', 'Actividad agregada');
    }

    // PREMIOS

    public function premios(){

        $premios = DB::table('premios')
            ->where('ref', auth()->user()->area)
            ->get();
        $prestadores = DB::table('solo_prestadores');

        if( auth()->user()->tipo == 'jefe area'){
            $prestadores->where('id_area', auth()->user()->area);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $prestadores->where('id_sede', auth()->user()->sede);
        }
        $prestadores = $prestadores->get();

        return view("admin.premios", compact('prestadores', 'premios'));
    }

    public function guardar_premio(Request $request){

        $request->validate([
            "nombre" => "required|string|max:255",
            "descripcion" => "required|string|max:255",  
            "tipo" => "required|string",
            "horas" => "integer|nullable|between:1,60", 
        ]);

        DB::table("premios")->insert([
            "nombre" => $request -> input("nombre"),
            "descripcion" => $request -> input("descripcion"),  
            "tipo" => $request -> input("tipo"),
            "horas" => $request -> input("horas"),
            "ref" => auth()->user()->area,
        ]);
       
        return redirect()->back()->with('success', 'Creada correctamente');
    }

    public function asignar_premio(Request $request){

        $prestadoresSeleccionados = $request->input('prestadores_seleccionados');
        $tamañoArreglo = count($prestadoresSeleccionados);

        for ($i = 0; $i < $tamañoArreglo; $i++) {

            $idp = $prestadoresSeleccionados[$i];
            DB::table("premios_prestadores")->insert([
                "id_premio" => $request -> input("premios"),
                "id_prestador" => $idp,  
            ]);
           
        }
        return redirect(route("admin.gestor_premios"))->with("Exito",);
    }

    public function gestor_premios(){
        $datos = DB::select("SELECT * FROM seguimiento_premios");
        return view("admin.Premios_tabulador", ["datosJson" => json_encode($datos)]);
    }

    public function eliminar_premio($id){
            
        DB::table("premios_prestadores")->where("id", $id)->delete();

        return response()->json(['message' => 'Premio Eliminado']);
    }

    public function verCambiarPassword(){
        return view('admin.cambioPassword');
    }

    public function actualizar_password(Request $request){
        
        $request->validate([
            'nuevaPassword' => 'required|min:8'    
        ],
        [
            'nuevaPassword.required'=>'El campo de contraseña es requerido',
            'nuevaPassword.min' => 'La contraseña debe ser de mínimo 8 caracteres'
        ]
        );
        
        $password = $request->nuevaPassword;
        $password = Hash::make($password);
        $actualizar = DB::table('users')->where('id', Auth::user()->id)->update(['password'=>$password]);

        return redirect()->route('login', ['success'=>'Actualización de credenciales, inicia sesión de nuevo']);
    }
}