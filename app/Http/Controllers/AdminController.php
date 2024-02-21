<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Visitas;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

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

    public function firmas(Request $request){
        
        $idSede = Auth::user()->sede;

        $sql = DB::table('registros_checkin as r')
            ->select('r.id', 'r.ubicacion', 'r.responsable', 'r.origen', 'r.fecha', 'r.hora_entrada', 'r.hora_salida', 'r.tiempo', 'r.horas', 'r.tipo', 'r.estado')
            ->join('users as u', 'r.encargado_id', '=', 'u.id')
            ->where('u.sede', $idSede)
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

    //ADMINSITRADOR DE PRESTADORES / VOLUNTARIOS / PRACTICANTES

    public function registro()
    {
        $id_S = Auth::user()->sede;
        $id_A = Auth::user()->area;
        $areas = null;
        $users = [];
        
        $users[] = ['id' => 'ext', 'value' => 'externo', 'name' => 'Visitante Externo'];
        $users[] = ['id' => "clientM", 'value' => 'maestro', 'name' => 'Visitante Maestro'];
        $users[] = ['id' => "clientA", 'value' => 'alumno', 'name' => 'Visitante Alumno'];
        $users[] = ['id' => "RBvoluntario", 'value' => 'voluntario', 'name' => 'Voluntario'];
        $users[] = ['id' => "RBpracticante", 'value' => 'practicante', 'name' => 'Practicas Profesionales'];
        $users[] = ['id' => "RBprestador", 'value' => 'prestador', 'name' => 'Prestador Servicio Social'];
        $users[] = ['id' => "RBencargado", 'value' => 'coordinador', 'name' => 'Coordinador'];

        if(in_array(Auth::user()->tipo, ['coordinador', 'jefe area'])) {
            $sedes = DB::select("SELECT * FROM sedes WHERE id_sede = $id_S;"); 
            $areas =  DB::select("SELECT * FROM areas WHERE id = $id_A;");
        }else if (Auth::user()->tipo == 'jefe sede'){
            $sedes = DB::select("SELECT * FROM sedes WHERE id_sede = $id_S;"); 
            $users[] = ['id' => "RBadmin", 'value' => 'jefe area', 'name' => 'Jefe de area'];
        }else if (Auth::user()->tipo == 'Superadmin'){
            $sedes = DB::select("SELECT * FROM sedes;");
            $users[] = ['id' => "RBadmin", 'value' => 'jefe area', 'name' => 'Jefe de area'];
            $users[] = ['id' => "RBadminsede", 'value' => 'jefe sede', 'name' => 'Jefe de Sede'];
        }
        
        return view('auth/registerAdmin', [ 'sedes'=>$sedes, 'areas'=>$areas, 'users'=>$users ]);
    }

    public function checkin()
    {
        return view('/auth/checkin', ['ruta' => 'registrar']);
    }

    
    public function general()
    {
        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $data = DB::table('users')
                ->select('users.name', 'users.apellido', 'users.correo', 'users.codigo', 'users.tipo', 'users.telefono', 'areas.nombre_area')
                ->whereNotIn('users.tipo', ['Superadmin','jefe sede','jefe area'])
                ->where('users.area', auth()->user()->area)
                ->join('areas', 'users.area', '=', 'areas.id')
                ->get();
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $data = DB::table('users')
            ->select('users.name', 'users.apellido', 'users.correo', 'users.codigo', 'users.tipo', 'users.telefono', 'areas.nombre_area')
            ->whereNotIn('users.tipo', ['Superadmin'])
            ->where('users.sede', auth()->user()->sede)
            ->join('areas', 'users.area', '=', 'areas.id')
            ->get();
        }else{
            $data = DB::table('users')
            ->select('users.name', 'users.apellido', 'users.correo', 'users.codigo', 'users.tipo', 'users.telefono', 'areas.nombre_area')
            ->whereNotIn('users.tipo', ['Superadmin'])
            ->join('areas', 'users.area', '=', 'areas.id')
            ->get();
        }

        return view('admin/general_users', ['datos' => json_encode($data)]);
    }

    public function administradores()
    {   
        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $n_Area = DB::table('areas')
                ->where('id', auth()->user()->area)
                ->value('nombre_area');
            $data = DB::table('solo_admins')
                ->where('solo_admins.area',$n_Area)
                ->get();
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $n_Sede = DB::table('sedes')
                ->where('id_sede', auth()->user()->sede)
                ->value('nombre_sede');
            $data = DB::table('solo_admins')
                ->where('solo_admins.sede',$n_Sede)
                ->get();
        }else{
            $data = DB::table('solo_admins')
            ->get();
        }
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
        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $n_area = DB::table('areas')
            ->where('id', Auth::user()->area)
            ->value('nombre_area');
            $data = DB::table('solo_prestadores')
                ->where('nombre_area', $n_area)
                ->get();
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $n_sede = DB::table('sedes')
            ->where('id_sede', Auth::user()->sede)
            ->value('nombre_sede');
            $data = DB::table('solo_prestadores')
                ->where('nombre_sede', $n_sede)
                ->get();
        }else{
            $data = DB::table('solo_prestadores')
            ->get();
        }
        
        return view('admin/activos', ['datos' => json_encode($data)]);
    }

    public function prestadores_pendientes()
    {
        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $data = DB::table('prestadores_pendientes')
                ->where('area', Auth::user()->area)
                ->get();
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $data = DB::table('prestadores_pendientes')
                ->where('sede',  Auth::user()->sede)
                ->get();
        }else{
            $data = DB::table('prestadores_pendientes')
            ->get();
        }

        return view('admin/prestadoresPendientes', ['datos' => json_encode($data)]);
    }

    public function prestadores_terminados()
    {
        if(Auth::user()->tipo == 'Superadmin')
        {
            $data = DB::table('prestadores_servicio_concluido')
            ->get();
            return view('admin/administrar_servicioConcluido', ['datos' => json_encode($data)]);
        }else{
            $data = DB::table('prestadores_servicio_concluido')
            ->where('sede', Auth::user()->sede)
            ->get();
            return view('admin/servicioConcluido', ['datos' => json_encode($data)]);
        }
    }

    public function prestadores_liberados()
    {
        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $data = DB::table('prestadores_servicio_liberado')
                ->where('area', Auth::user()->area)
                ->get();
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $data = DB::table('prestadores_servicio_liberado')
                ->where('sede',  Auth::user()->sede)
                ->get();
        }else{
            $data = DB::table('prestadores_servicio_liberado')
            ->get();
        }

        return view('admin/servicioLiberado', ['datos' => json_encode($data)]);
    }

    public function prestadores_inactivos()
    {
        $data = DB::table('prestadores_inactivos')
        ->where('area', Auth::user()->area)
        ->get();

        if( auth()->user()->tipo == 'coordinador'){
           
            return view('admin/prestadoresInactivos', ['datos' => json_encode($data)]);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $data = DB::table('prestadores_inactivos')
                ->where('sede',  Auth::user()->sede)
                ->get();
        }else{
            $data = DB::table('prestadores_inactivos')
            ->get();
        }
        return view('admin/administrar_prestadoresInactivos', ['datos' => json_encode($data)]);
    }

    public function activar($id) {

        $type = DB::table('users')
        ->select('tipo')
        ->where('id', $id)
        ->value('tipo');
        
        if(($type == 'prestadorp') || ($type == 'prestador_inactivo')){
            DB::table('users')
            ->where('id', $id)
            ->update(['tipo' => 'prestador']);
        }else if(($type == 'voluntariop') || ($type == 'voluntario_inactivo')){
            DB::table('users')
            ->where('id', $id)
            ->update(['tipo' => 'voluntario']);
        }else if(($type == 'practicantep') || ($type == 'practicante_inactivo')){
            DB::table('users')
            ->where('id', $id)
            ->update(['tipo' => 'practicante']);
        }

        return response()->json(['message' => 'Activado exitosamente']);
    }

    public function desactivar($id) {

        $type = DB::table('users')
        ->where('id', $id)
        ->value('tipo');

        if($type == ('prestador')){
            DB::table('users')
            ->where('id', $id)
            ->update(['tipo' => 'prestador_inactivo']);
        }else if($type == ('voluntario')){
            DB::table('users')
            ->where('id', $id)
            ->update(['tipo' => 'voluntario_inactivo']);
        }else if($type == ('practicante')){
            DB::table('users')
            ->where('id', $id)
            ->update(['tipo' => 'practicante_inactivo']);
        }
    
        return response()->json(['message' => 'Desactivado exitosamente']);
    }

    public function eliminar($id) {
        
        User::where('id', $id)
        ->delete();
    
    return response()->json(['message' => 'Prestador eliminado']);
}

    public function liberar($id) {

            DB::table('users')
            ->where('id', $id)
            ->update(['fecha_salida' => Carbon::now()]);
        

        return response()->json(['message' => 'Liberado exitosamente']);
    }

    public function cambiar_horario($id, $horario){

        if($horario == "Matutino"){
            $n_Turno = "turnoMatutino";
        }else if($horario == "Mediodia"){
            $n_Turno = "turnoMediodia";   
        }else if($horario == "Vespertino"){
            $n_Turno = "turnoVespertino";
        }else if($horario == "Tiempo Completo"){
            $n_Turno = "turnoTiempoCompleto";
        }else if($horario == "Sabatino"){
            $n_Turno = "turnoSabatino";
        }

        $area = DB::table('users')
        ->where('id', $id)
        ->value('area');
       
        DB::table('users')
        ->where('id', $id)
        ->update([
            'horario' => DB::table('areas')->where('id', $area)->value($n_Turno) == 1 ? $horario : DB::raw('horario')]);

            return response()->json(['message' => 'Activado exitosamente']);
    }

    public function cambiar_tipo($id, $value){

        DB::table('users')
        ->where('id', $id)
        ->update(['tipo' => $value]);

        return response()->json(['message' => 'Modificado exitosamente']);
    }

    // ACTIVIDADES Y PROYECTOS

    public function detallesActividad($value)
    {

        $detalles = DB::table('actividades')
            ->select('actividades.*', 'categorias.nombre AS nombre_categoria', 'subcategorias.nombre AS nombre_subcategoria')
            ->join('categorias', 'actividades.id_categoria', '=', 'categorias.id')
            ->leftJoin('subcategorias', 'actividades.id_subcategoria', '=', 'subcategorias.id') 
            ->where('actividades.id', $value)
            ->first();

        return view('/admin/admin_detalles_actividad', [ 'detalle' => $detalles]);
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
    
    public function create_act()
    {
        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $prestadores = DB::table('solo_prestadores')
                ->where('id_area', auth()->user()->area)
                ->where('horario', auth()->user()->horario)
                ->get();
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $prestadores = DB::table('solo_prestadores')
                ->where('id_sede', auth()->user()->sede)
                ->where('horario', auth()->user()->horario)
                ->get();
        }

        $categorias = DB::table('categorias')->get();
        $subcategorias = DB::table('subcategorias')->get();
    
        return view('/admin/registro_actividades',
                ['prestadores' => $prestadores,
                'categorias' => $categorias,
                'subcategorias' => $subcategorias]);
    }
    
    public function make_act(Request $request) {
        $nomact = $request->input('nombre');

        $categoria = $request->input('tipo_categoria');
        $subcategoria = $request->input('tipo_subcategoria');
        if($subcategoria == '')
            $subcategoria = null;
        $tipo = $request->input('tipo_actividad');

        $desc = $request->input('descripcion');
        $reso = $request->input('recursos');
        $obj = $request->input('resultados');
    
        $horas = $request->input('horas')*60;
        $minutos = $request->input('minutos');
        $tec = $horas + $minutos;
    
        DB::table('actividades')->insert([
    
            'titulo' => $nomact,
            'id_categoria' => $categoria,
            'id_subcategoria' => $subcategoria,
            'tipo' => $tipo,
            'recursos' => $reso,
            'descripcion' => $desc,
            'objetivos' => $obj,
            'TEC' => $tec,]);
    
        return redirect(route('admin.asign_act'));
    }

    public function asign_act(){
    
        if( auth()->user()->tipo == 'coordinador'){
            $prestadores = DB::table('solo_prestadores')
                ->where('id_area', auth()->user()->area)
                ->where('horario', auth()->user()->horario)
                ->get();
        }else if(auth()->user()->tipo == 'jefe area'){
            $prestadores = DB::table('solo_prestadores')
            ->where('id_area', auth()->user()->area)
            ->get();
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $prestadores = DB::table('solo_prestadores')
                ->where('id_sede', auth()->user()->sede)
                ->get();
        }else{
            $prestadores = DB::table('solo_prestadores')
            ->get();
        }
            
        $categorias = DB::table('categorias')->get();
        $actividades = DB::table('actividades')->get();
        $proyectos = DB::table('proyectos')->get();
    
        return view( 'admin/asignar_actividades', [
            'prestadores' => $prestadores,
            'categorias' => $categorias,
            'actividades' => $actividades,
            'proyectos' => $proyectos]);
    }

    public function asign(Request $request){

        $ida = $request->input('tipo_actividad');
        $idpy = $request->input('proyecto');
        $prestadoresSeleccionados = $request->input('prestadores_seleccionados');
        $tamañoArreglo = count($prestadoresSeleccionados);

        for ($i = 0; $i < $tamañoArreglo; $i++) {

            $idp = $prestadoresSeleccionados[$i];
            DB::table('actividades_prestadores')->insert([
                'id_prestador' => $idp,
                'id_actividad' => $ida,
                'id_proyecto' => $idpy,]);
        }

        return redirect(route('admin.asign_act'))->with('success', 'Creada correctamente');
    }


    public function create_proy() {

        if( auth()->user()->tipo == 'coordinador'){
            $prestadores = DB::table('solo_prestadores')
                ->where('id_area', auth()->user()->area)
                ->where('horario', auth()->user()->horario)
                ->where('tipo', '!=', 'coordinador')
                ->get();
            $areas = DB::table('areas')
                ->select('id', 'nombre_area')
                ->where('id', auth()->user()->area)
                ->get();

        }else if(auth()->user()->tipo == 'jefe area'){

            $prestadores = DB::table('solo_prestadores')
            ->where('id_area', auth()->user()->area)
            ->get();

            $areas = DB::table('areas')
                ->select('id', 'nombre_area')
                ->where('id', auth()->user()->area)
                ->get();
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $prestadores = DB::table('solo_prestadores')
                ->where('id_sede', auth()->user()->sede)
                ->where('horario', auth()->user()->horario)
                ->get();
                $areas = DB::table('areas')
                ->select('id', 'nombre_area')
                ->where('id_sede', auth()->user()->sede)
                ->get();
        }else{
            $prestadores = DB::table('solo_prestadores')
            ->get();
            $areas = DB::table('areas')
                ->select('id', 'nombre_area')
                ->get();
        }

        $categorias = DB::table('categorias')->get();
        $proyectos = DB::table('proyectos')->get();

        return view('/admin/registro_proyectos',[
            'categorias' => $categorias,
            'proyectos' => $proyectos,
            'areas' => $areas,
            'prestadores' => $prestadores,]);
    }

    public function make_proy(Request $request){
            
        $ida = $request->input('area');
        if($request->input('particular') === 'on'){
            $boolp = true;
        }else{
            $boolp = false;
        }

        $idpy = DB::table('proyectos')->insertGetId([
            'titulo' => $request->t_nombre,
            'id_area' => $ida,
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

    public function view_proy(){
        $tabla_proy = DB::table('seguimiento_proyecto')
        ->get();
        
        return view('admin.ver_proyectos', ['tabla_proy' => $tabla_proy]);
    }
    public function view_details_proy($id){

        $proyecto = DB::table('Proyectos')->select('titulo')->where('id',$id)->get();
        $prestadores = DB::table('proyectos_prestadores')
        ->select('id_prestador', 'name', 'apellido', 'correo', 'telefono')
        ->where('id_proyecto', $id)
        ->join('users', 'id_prestador','=','users.id')->get();
        $actividades = DB::table('seguimiento_actividades')->select('actividad_id','actividad', 'estado', 'prestador')->where('id_proyecto', $id)->get();
        
        //dd($prestadores);
        return view('admin.ver_detalles_proyecto', compact('proyecto','prestadores', 'actividades'));
    }

    public function view_details_act($id){
        
        return view('admin.ver_detalles_actividad');
    }
    

    public function asign2(Request $request){

        $idp = $request->input('proyecto');
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
                'id_proyecto' => $idp
            ]);
        }

        return redirect(route('admin.create_proy'))->with('success', 'Asignaciones realizadas con exito');
    }

    public function obtenerPrestadores(Request $request)
    {
        $id = $request->input('proyectoId');

        $prestadores = DB::table('solo_prestadores')
        ->select('solo_prestadores.id','solo_prestadores.name', 'solo_prestadores.apellido')
        ->join('proyectos_prestadores', 'solo_prestadores.id', '=', 'proyectos_prestadores.id_prestador')
        ->where('proyectos_prestadores.id_proyecto', $id)
        ->get();

        return response()->json($prestadores);
    }

    //IMPRESORAS

    public function watch_prints()
    {
        $sede = auth()->user()->sede;
      
        $data = DB::table('ver_impresiones')
            ->select('ver_impresiones.id','impresora', 'proyecto', 'fecha', 'nombre_modelo_stl', 'tiempo_impresion', 'color', 'piezas', 'estado', 'peso', 'observaciones')
            ->join('users', 'ver_impresiones.id_Prestador', '=', 'users.id')
            ->where('sede', $sede)
            ->get();
        return view( 'admin/mostrar_impresiones', [ 'impresiones' =>json_encode($data)]);
    }

    public function control_print()
    {
        $data = DB::table('impresoras')
        ->where('id_sede', auth()->user()->sede)
        ->get();

        return view('admin/registro_impresora',
            [ 'impresiones' =>json_encode($data)
        ]);
    }

    public function activate_print($id) {

        $act = DB::table('impresoras')
        ->select('estado')
        ->where('id', $id)
        ->get();

        if($act->first()->estado === 1){
            DB::table('impresoras')
            ->where('id', $id)
            ->update(['estado' => '0']);
        }else{
            DB::table('impresoras')
            ->where('id', $id)
            ->update(['estado' => '1']);
        }

        return response()->json(['message' => 'Impresora activada']);
    }

    public function detail_prints($id, $value) {

        $sql=    DB::table('seguimiento_impresiones')
            ->where('id', $id)
            ->update(['observaciones' => $value]);
        return response()->json(['message' => $sql]);
    }

    public function printstate($id, $state) {

        DB::table('seguimiento_impresiones')
        ->where('id', $id)
        ->update(['estado' => $state]);

        return response()->json(['message' => 'Activado exitosamente' . $id]);
    }

    public function make_print(Request $request)
    {

        $name = $request->input('nombre');
        $mark = $request->input('mark');
        $type = $request->input('tipo');

        DB::table('impresoras')->insert([
            'nombre' => $name,
            'marca' => $mark,
            'tipo' => $type,
            'id_sede' =>auth()->user()->sede

        ]);

        $data = DB::table('impresoras')
        ->get();

        return redirect()->back();
    }

    //CATEGORIAS Y SUBCATEGORIAS

    public function categorias(){

        $categ= DB::select("SELECT * FROM categorias");
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
        
        $reportes = session('reportes');
        $codigo = session('codigo');
        if(Auth::user()->tipo == "jefe area"){
            $prestadores = DB::table('users')
            ->where('area', Auth::user()->area)
            ->where('sede', Auth::user()->sede)
            ->get();
        }elseif (Auth::user()->tipo == "jefe sede"){
            $prestadores = DB::table('users')
            ->where('sede', Auth::user()->sede)
            ->get();
        }
        
        return view('admin.ver_reportes_parciales', ['reportes'=>$reportes, 'codigo'=>$codigo, 'prestadores'=>$prestadores]);
    }

    public function busqueda_reportes_parciales(Request $request){
        if ($request->busqueda==""){
            return redirect()->route('admin.reportes_parciales')->with(['warning'=>'Debes ingresar un código/nombre']);
        }

        $id_prestador = DB::select("Select id from users where codigo = $request->busqueda");
    
        if(count($id_prestador) == 0){
            return redirect()->route('admin.reportes_parciales')->with('warning', 'El prestador no existe');
        }
        $id = $id_prestador[0]->id;
        $reportes = DB::select("Select * from reportes_s_s where id_prestador = $id");

        if(count($reportes) != 0){
            return redirect()->route('admin.reportes_parciales')->with(['success'=>'Registro encontrado', 'reportes'=>$reportes, 'codigo'=> $request->busqueda]);
        }else{
            return redirect()->route('admin.reportes_parciales')->with(['warning'=>"No se encontraron registros del prestador", 'reportes'=>$reportes, 'codigo'=> $request->busqueda]);
        }
        
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
        $sql=    DB::table('visitas')
            ->where('id', $id)
            ->update(['motivo' => $value]);
        return response()->json(['message' => $sql]);
    }


    public function registrarVisitas(Request $request)
    {
        $insert = Visitas::create($request->all());
        return redirect('/')->with('success', 'Creado correctamente');
    }

    public function salidaVisita(Request $request)
    {
        $id = $request->input('id');
        $vmodificar = Visitas::findOrFail($id);

        $currentDateTime = date('Y-m-d H:i:s');
        $newDateTime = date('h:i A', strtotime($currentDateTime));
        $newDateTime2 = date('Y-m-d H:i:s', strtotime($currentDateTime));

        $vmodificar->hora_salida = $newDateTime2;
        $vmodificar->fecha_salida = $newDateTime2;

        $vmodificar->save();
        return redirect()->route('admin.visitas');
    }

    //CONTROL DE SEDES

    public function gestionSedes(){
        
        if(auth()->user()->tipo == 'Superadmin'){
            $sedes = DB::table('sedes_areas')->get();
            $s = DB::table('sedes')->get();
        }else{
            $sedes = DB::table('sedes_areas')->where('id_sede', '=', auth()->user()->sede)->get();
            $s = DB::table('sedes')->where('id_sede', '=', auth()->user()->sede)->get();
        }

        
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

    public function diasfestivos()
    {   
        $sede=Auth::user()->sede;
        $area=Auth::user()->area;
        $no_laboral = DB::select("Select * from eventos where sede = $sede and (area = $area or area = 0 ) order by inicio;");
        foreach($no_laboral as $valor){
            // Crear un objeto DateTime interpretando la cadena original
            $fechaObjeto = DateTime::createFromFormat('Y-m-d H:i:s', $valor->inicio);
            // Obtener la nueva cadena de fecha en el formato deseado ("d/m/Y")
            $valor->inicio = $fechaObjeto->format('d-m-Y');

            $fechaObjeto = DateTime::createFromFormat('Y-m-d H:i:s', $valor->final);
            // Obtener la nueva cadena de fecha en el formato deseado ("d/m/Y")
            $valor->final = $fechaObjeto->format('d-m-Y');
        }

        return view('admin.dias_festivos',['no_laboral' =>json_encode($no_laboral)]);
    }

    public function guardarFestivos(Request $request)
    {   
        if($request->input('tipo')=='vacaciones'){

            $modificar = DB::table('eventos')->insert(
                ['evento'=> ($request->input('descripcion')!=null) ? $request->input('descripcion') : 'No laborable',                   
                'inicio' => $request->input('vacacionesInicio'),
                'final'=> $request->input('vacacionesFin'),
                'tipo'=>$request->input('tipo'),
                'sede'=>$request->input('sede'),
                'area'=>$request->input('area')]
            );
        }else{
            $modificar = DB::table('eventos')->insert(
                ['evento'=> ($request->input('descripcion')!=null) ? $request->input('descripcion') : 'No laborable',                   
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
        $id_festivo = $request->id_festivo;
        $tipo = $request->tipo;
        $inicio = $request->inicio;
        $fin = $request->fin;
        $descripcion = $request->descripcion;

        if($tipo == 'festivo'){
            $fin = $inicio;
        }

        $actualizar = DB::table('eventos')->where('id', $id_festivo)->update(['evento'=>$descripcion, 'inicio'=>$inicio, 'final'=>$fin]);

        return redirect()->route('admin.diasfestivos')->with('success', 'Modificado correctamente');
    }

    public function eliminardiafestivo($id)
    {
        $modificar = DB::table('eventos')->where('id', $id)->delete();
        return response()->json(['message' => 'Festivo eliminado']);
    }


    public function obtenerActividades(Request $request)
    {
        $categoriaId = $request->input('categoriaId');

        $actividades = DB::table('actividades')
            ->where('id_categoria', $categoriaId)
            ->get();

        return response()->json($actividades);
    }

    public function obtenerActividadesB(Request $request)
    {
        $subcategoriaId = $request->input('subcategoriaId');

        $actividades = DB::table('actividades')
            ->where('id_subcategoria', $subcategoriaId)
            ->get();

        return response()->json($actividades);
    }

    public function obtenerSubcategoria(Request $request)
    {
        $categoriaId = $request->input('categoriaId');

        $subcateg = DB::table('subcategorias')
            ->where('categoria', $categoriaId)
            ->get();

        return response()->json($subcateg);
    }

    // PREMIOS
    public function premios(){

        $premios = DB::select("SELECT * FROM premios");

        if( auth()->user()->tipo == 'jefe area'){
            $prestadores = DB::table('solo_prestadores')
                ->where('id_area', auth()->user()->area)
                ->get();
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $prestadores = DB::table('solo_prestadores')
            ->where('id_sede', auth()->user()->sede)
            ->get();
        }else{
            $prestadores = DB::table('solo_prestadores')
            ->get();
        }
        return view("admin.premios", ["prestadores"=>$prestadores, "premios"=>$premios]);
    }

    public function guardar_premio(Request $request){
        $request->validate([
            "nombre" => "required",
            "descripcion" => "required",  
            "tipo" => "required",
            "horas" => "required",
        ]);

        DB::table("premios")->insert([
            "nombre" => $request -> input("nombre"),
            "descripcion" => $request -> input("descripcion"),  
            "tipo" => $request -> input("tipo"),
            "horas" => $request -> input("horas"),
            "ref" => "ref",
        ]);
       
        return redirect()->back()->with("Exito",);
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
        
        return redirect()->back()->with("Exito",);
    }

    public function gestor_premios(){
        $datos = DB::select("SELECT * FROM seguimiento_premios");
        $datosJson = json_encode($datos);

        return view("admin.Premios_tabulador", ["datosJson" => $datosJson]);
    }

    public function eliminar_premio($id){
            
        $datos = DB::table("premios_prestadores")->where("id", $id)->delete();

        return response()->json(['message' => 'Premio Eliminado']);
    }
}