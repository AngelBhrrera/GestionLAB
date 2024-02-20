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
        $actividades = DB::table('seguimiento_actividades')->select('actividad_id','actividad', 'estado', 'prestador')->get();
        
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
                ['evento'=> $request->input('descripcion'),                   
                'inicio' => $request->input('vacacionesInicio'),
                'final'=> $request->input('vacacionesFin'),
                'tipo'=>$request->input('tipo'),
                'sede'=>auth()->user()->sede,
                'area'=>auth()->user()->area]
            );
        }else{
            $modificar = DB::table('eventos')->insert(
                ['evento'=> $request->input('descripcion'),                   
                'inicio' => $request->input('diaFestivo'),
                'final'=> $request->input('diaFestivo'),
                'tipo'=>$request->input('tipo'),
                'sede'=>auth()->user()->sede,
                'area'=>auth()->user()->area]
            );
        }
        
        return redirect()->route('admin.diasfestivos');
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
//VIEJO CONTROLLER. /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
    //Guardar Estado
    public function guardar(Request $request)
    {
        print_r("hola");
        $id = $request->input('id');
        $estado = $request->input('estado');
        $responsable = $request->input('responsable');
        $modificar = DB::table('registros_checkin')->where('id', $id)->update(['estado' => $estado, 'responsable' => $responsable]);   

    }

    //Guardar Horas
    public function guardar2(Request $request)
    {
        print_r("hola");
        $id = $request->input('id');
        $horas = $request->input('horas');
        $responsable = $request->input('responsable');
        $modificar = DB::table('registros_checkin')->where('id', $id)->update(['horas' => $horas, 'responsable' => $responsable]);
    }


    public function guardarstatus(Request $request)
    {
        print_r("gurdarstatus");
        $id_citas = $request->input('id');
        $status = $request->input('status');
        $modificar = DB::table('cita_clientes')->where('id_citas', $id_citas)->update(['status' => $status]);
    }


    public function consultacursos1(Request $request)
    {
        print_r("consulta1");
        $id = $request->input('id');
        $curso3 = $request->input('curso3');
        $modificar = DB::table('clientes')->select('curso1')->where('id', $id)->get();
        print_r($modificar);
        return ($modificar
        );
    }


    /*public function clientes()
    {
        $columns = array(
            ["data" => "id", "visible" => false],
            ["data" => "name"],
            ["data" => "apellido"],
            ["data" => "correo"],
            ["data" => "codigo"],
            ["data" => "tipo_cliente"],
            ["data" => "created_at"],
            ["data" => "horas_voluntario"],
            ["data" => "acciones", "sortable" => false],
            ["data" => "eliminar", "sortable" => false]
        );

        return view(
            '/admin/homeA',
            [
                'datos' => [
                    'Id',
                    'Nombre(s)',
                    'Apellido(s)',
                    'Correo',
                    'Codigo',
                    'Tipo de cliente',
                    'Fecha de inscripción',
                    'horas_voluntario',
                    'Modificar',
                    'Eliminar'
                ], //'fecha'],
                'opcion' => 'table',
                'titulo' => 'Tabla Clientes',
                'ajaxroute' => 'ss.ssClientes',
                "columnas" => json_encode($columns)
            ]
        );
    }

    public function citas()
    {
        $columns = array(["data" => "id", "visible" => false], ["data" => "fecha"], ["data" => "correo"], ["data" => "nombre"], ["data" => "proyecto"], ["data" => "status", "sortable" => false], ["data" => "btn", "sortable" => false], ["data" => "eliminar", "sortable" => false], ["data" => "link", "sortable" => false]);
        $prestadores = DB::table('solo_prestadores')->where('tipo', 'prestador')->get();

        return view(
            '/admin/homeA',
            [
                'datos' => ['ID', 'Fecha del documento', 'Correo', 'Nombre', 'Proyecto', 'Status', 'Acciones', 'Eliminar', 'Enlace Drive'],
                'opcion' => 'table',
                'titulo' => 'Tabla de solicitudes pendientes',
                'ajaxroute' => 'ss.ssCitas',
                'prestadores' => $prestadores,
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'enlace' => true,
                'cursos' => false,
                'descarga' => false
            ]
        );
    }

    public function citas_pendientes()
    {
        $columns = array(["data" => "id", "visible" => false], ["data" => "fecha"], ["data" => "correo"], ["data" => "nombre"], ["data" => "proyecto"], ["data" => "status", "sortable" => false], ["data" => "btn", "sortable" => false], ["data" => "link", "sortable" => false]);

    $prestadores = DB::table('solo_prestadores')->where('tipo', 'prestador')->get();
        return view(
            '/admin/homeA',
            [
                'datos' => ['ID', 'Fecha del documento', 'Correo', 'Nombre', 'Proyecto', 'Status', 'Acciones', 'Enlace Drive'],
                'opcion' => 'table',
                'titulo' => 'Tabla de citas pendientes',
                'ajaxroute' => 'ss.ssCitas_pendientes',
                'prestadores' => $prestadores,
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'enlace' => true,
                'cursos' => false,
                'descarga' => false
            ]
        );
    }

    public function verCredencial(Request $request)
    {
        $descargasNombre = $request->input('descargaName');
        print_r($descargasNombre);
        //ob_end_clean(); //esta cosa limpia el cache y hace que se descargue bien x)
        if (ob_get_contents()) ob_get_clean();
        $pathtoFile = public_path() . '/img/credencial/' . $descargasNombre;
        return response()->download($pathtoFile);
    }

    public function verRender(Request $request)
    {
        $descargasNombre = $request->input('descargaName');
        print_r($descargasNombre);
        //ob_end_clean(); //esta cosa limpia el cache y hace que se descargue bien x)
        if (ob_get_contents()) ob_get_clean();
        $pathtoFile = public_path() . '/img/render/' . $descargasNombre;
        return response()->download($pathtoFile);
    }

    public function descargarArchivo(Request $request)
    {
        $descargasNombre = $request->input('descargaName');
        print_r($descargasNombre);
        //ob_end_clean(); //esta cosa limpia el cache y hace que se descargue bien x)
        if (ob_get_contents()) ob_get_clean();
        $pathtoFile = public_path() . '/img/archivo/' . $descargasNombre;
        return response()->download($pathtoFile);
    }    

    public function visitas()
    {

        $columns = array(["data" => "id", "visible" => false], ["data" => "name"], ["data" => "apellido"], ["data" => "fecha"], ["data" => "hora_llegada", "sortable" => false], ["data" => "hora_salida", "sortable" => false], ["data" => "numero", "sortable" => false], ["data" => "motivo", "sortable" => false], ["data" => "responsable"], ["data" => "eliminar", "sortable" => false]);

        return view(
            '/admin/homeA',
            [
                'datos' => [
                    'id',
                    'Nombre(s)',
                    'Apellidos(s)',
                    'Fecha',
                    'Hora de llegada',
                    'Hora de salida',
                    'Numero de Telefono',
                    'Motivo',
                    'Responsable',
                    'Eliminar',
                ],
                'opcion' => 'table',
                'titulo' => 'Tabla Visitas',
                'ajaxroute' => 'ss.sstablavisitas',
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => true,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }

    public function premios()
    {
        $users = DB::table('premios')->orderBy('id', 'DESC')->get();

        return view(
            '/admin/homeA',
            [
                'users' => $users, 'datos' => ['nombre', 'descripcion', 'tipo', 'horas'],
                'tipo' => 'admin',
                'opcion' => 'table',
                'titulo' => 'Tabla Administradores',
                'button' => false,
                'accion' => true,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }

    public function recompensas()
    {
        return view(
            '/admin/homeA',
            [
                'opcion' => 'registro_recompensas'
            ]
        );
    }

    public function actividad_asignada(Request $request)
    {
        $nomact = $request->input('nombre');
        $tipo = $request->input('tipo_actividad');
        // $tipo = DB::table('actividades')->get();
        $desc = $request->input('descripcion');
        $obj = $request->input('objetivo');
        $fecha = date('d/m/Y H:m');
        // $fecha = $request->input('datepiker');
        $horas = $request->input('horas');
        $minutos = $request->input('minutos');
        //$tiempo_estimado = "$horas:$minutos:00";
        $tiempo_estimado = new \DateTime();
        $tiempo_estimado->setTime($horas, $minutos);
        $tipo2 = $request->input('tipo');
        $llaveact = $nomact . $fecha;
        $id_actividad = $request->input('id_actividad');

        $usuarioActual = auth()->user()->id;
        $categorias = DB::table('categorias')->get();

        if ($tipo2 == "agregar") {

            // para cada prestador seleccionado, crear una actividad por separado
            // esto para tener control del tiempo por separado (del usuario)
            $prestadores = $request->input('duallistbox_demo1');
            foreach ($prestadores as $prestador) {
                $actividadId = DB::table('c_actividad')->insertGetId([
                    'nombre_act' => $nomact,
                    'acti_id' => $tipo,
                    'descripcion' => $desc,
                    'objetivo' => $obj,
                    'status' => 'creado',
                    'fecha' => $fecha,
                    'coordinador_id' => $usuarioActual,
                    'creacion_id' => $usuarioActual,
                    'estimacion_tiempo' => $tiempo_estimado,
                    'asignado_a' => $prestador
                ]);

                DB::table('actividades_prestadores')->insert([
                    'llave_actividad' => $actividadId,
                    'id_prestador' => $prestador
                ]);
            }
            return redirect('admin/actividades')->with('success', "Se guardó correctamente");
        } else if ($tipo2 == "modificar") {

            $crear = DB::table('c_actividad')->where('id_actividad', $id_actividad)->update(
                [
                    'nombre_act' => $nomact,
                    'acti_id' => $tipo,
                    'descripcion' => $desc,
                    'objetivo' => $obj,
                    'fecha' => $fecha,
                    'estimacion_tiempo' => $tiempo_estimado,
                ]

            );

            $prestadores = $request->input('duallistbox_demo1');
            // echo "<script> alert('modificar'); </script>";

            $eliminar = DB::table('actividades_prestadores')->where('llave_actividad', $id_actividad)->delete();

            foreach ($prestadores as $prestador) {

                $insertar2 = DB::table('actividades_prestadores')->insert(['llave_actividad' => $id_actividad, 'id_prestador' => $prestador]);
            }

            return redirect('/')->with('success', "Se modificó correctamente");
        }

        //
    }
    public function actividad_reasignada(Request $request)
    {
        $tipo2 = $request->input('tipo');
        $id_actividad = $request->input('id_actividad');

        $usuarioActual = auth()->user()->id;
        $categorias = DB::table('categorias')->get();

        if ($tipo2 == "canceladas") {
            $prestadores = $request->input('duallistbox_demo1');
            foreach ($prestadores as $prestador) {
                DB::table('c_actividad')
                    ->where('id_actividad', $id_actividad)
                    ->update([
                        'status' => 'creado',
                        'asignado_a' => $prestador
                    ]);

                DB::table('actividades_prestadores')->insert([
                    'llave_actividad' => $id_actividad,
                    'id_prestador' => $prestador
                ]);
            }
            return redirect('admin/tabla_actividades_canceladas')->with('success', "Se reasigno correctamente");
        }

    }

    public function agregarCategoriaActividad(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required',
            'nombre_actividad.*' => 'required',
            'horas_actividad.*' => 'required',
            'minutos_actividad.*' => 'required',
        ]);

        $categoriaId = DB::table('categorias')->insertGetId([
            'nombre' => $request->input('nombre_categoria')
        ]);

        $actividades = [];

        for ($i = 0; $i < count($request->nombre_actividad); $i++) {
            $actividades[] = [
                'categoria_id' => $categoriaId,
                'nombre' => $request->nombre_actividad[$i],
                'horas' => $request->horas_actividad[$i] . ':' . $request->minutos_actividad[$i]
            ];
        }

        DB::table('actividades')->insert($actividades);

        return redirect('admin/actividades')->with('success', 'Se guardaron correctamente las actividades.');
    }

    public function actividad_cancelar(Request $request)
    {

        // la variable $diferencia calcula la diferencia entre el tiempo de tolerancia y la duración de la actividad.
        //Luego, se utiliza una estructura de control if para determinar si la actividad puede continuar o no, basado en el valor de $diferencia.
        //Si $diferencia es menor que cero, se actualiza el estado de la actividad a "cancelado_permitido".
        //De lo contrario, se actualiza el estado a "cancelado".

        $id_actividad = $request->input('id');

        $actividad = DB::table('c_actividad')
            ->select('c_actividad.*')
            ->where('id_actividad', $id_actividad)
            ->first();

        $actividad_hora = DB::table('actividades')
            ->where('id', $actividad->acti_id)
            ->value('horas');

        $teu = $actividad->estimacion_tiempo; //tiempo estimado del usuario
        $duracion = $actividad->duracion; //duracion de la actividad (fecha fin - fecha inicio)
        // Convertir los valores de tiempo en segundos
        $teu_segundos = strtotime($teu) - strtotime('00:00:00');
        $duracion_segundos = strtotime($duracion) - strtotime('00:00:00');
        $actividad_hora_segundos = strtotime($actividad_hora) - strtotime('00:00:00');

        // Sumar los valores de tiempo en segundos
        $tolerancia_segundos = $teu_segundos + $duracion_segundos;

        // Convertir los segundos en formato "HH:MM:SS"
        $tt = gmdate("H:i:s", $tolerancia_segundos); //tiempo de tolerancia

        $tt_segundos = strtotime($tt) - strtotime('00:00:00'); //tiempo de tolerancia en segundos

        $diferencia = $tt_segundos - $duracion_segundos;

        if ($diferencia < $actividad_hora_segundos) {
            $modificar = DB::table('c_actividad')->where('id_actividad', $id_actividad)->update(
                [
                    'status' => 'cancelado_permitido',
                    'nota_error' => $request->nota_error,
                    'duracion' => null,
                    'fecha_fin' => null
                ]
            );
            return redirect('/')->with('success', "Se modificó correctamente");
        } else {
            $modificar = DB::table('c_actividad')->where('id_actividad', $id_actividad)->update(
                [
                    'status' => 'cancelado',
                    'nota_error' => $request->nota_error
                ]
            );
            return redirect('/')->with('success', "Se modificó correctamente");
        }
    }

    public function actividades()
    {
        $columns = array(
            ["data" => "id_actividad", "visible" => false],
            ["data" => "llave_actividad", "visible" => false],
            ["data" => "asignado_a"],
            ["data" => "nombre_act"],
            ["data" => "tipo_categoria"],
            ["data" => "tipo_actividad"],
            ["data" => "descripcion", "sortable" => false],
            ["data" => "objetivo", "sortable" => false],
            ["data" => "fecha"],
            ["data" => "acciones", "sortable" => false],
            ["data" => "eliminar", "sortable" => false]
        );
        return view(
            '/admin/homeA',
            [
                'datos' => ['id_actividad', 'llave_act', 'Prestador', 'Nombre act.', 'Tipo categoria', 'Tipo act.', 'descripción', 'objetivo', 'fecha', 'acciones', 'eliminar'],
                'opcion' => 'table',
                'titulo' => 'Tabla de Actividades creadas',
                'ajaxroute' => 'ss.ssActividad',
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }

    public function actividades_revision()
    {

        $columns = array(
            ["data" => "id_actividad", "visible" => false],
            ["data" => "asignado_a"],
            ["data" => "nombre_act"],
            ["data" => "tipo_categoria"],
            ["data" => "tipo_actividad"],
            ["data" => "descripcion", "visible" => false, "sortable" => false],
            ["data" => "objetivo", "visible" => false, "sortable" => false],
            ["data" => "fecha"],
            ["data" => "estimacion_tiempo"],
            ["data" => "duracion"],
            ["data" => "acciones", "sortable" => false],

        );



        return view(
            '/admin/homeA',
            [
                'datos' => ['id_actividad', 'Prestador', 'Nombre act.', 'Tipo de categoria', 'Tipo act.', 'Descripcion', 'Objetivo', 'Fecha', 'Estimacion tiempo', 'Duracion', 'Acciones'],
                'opcion' => 'table',
                'titulo' => 'Tabla de Actividades en revisión',
                'ajaxroute' => 'ss.ssActividadR',
                'columnas' => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }


    public function terminar_actividad(Request $request)
    {
        $id = $request->input('id');
        //echo "<script> alert(JSON.stringify($id)); </script>";
        $modificar = DB::table('c_actividad')->where('id_actividad', $id)->update(['status' => "terminado_revisado"]);
        return redirect()->route('admin.actividades_revision');
    }

    public function tabla_terminados()
    {

        $columns = array(
            ["data" => "id_actividad", "visible" => false],
            ["data" => "asignado_a"],
            ["data" => "nombre_act"],
            ["data" => "tipo_categoria"],
            ["data" => "tipo_actividad"],
            ["data" => "descripcion", "visible" => false, "sortable" => false],
            ["data" => "objetivo", "visible" => false, "sortable" => false],
            ["data" => "fecha"],
            ["data" => "estimacion_tiempo"],
            ["data" => "duracion"],
            ["data" => "experiencia_obtenida"],
            // ["data" => "acciones", "sortable" => false]
        );
        return view(
            '/admin/homeA',
            [
                'datos' => ['id_actividad', 'Prestador', 'Nombre act.', 'Tipo categoria', 'Tipo act.', 'Descripcion', 'Objetivo', 'Fecha', 'Estimacion tiempo', 'Duración', 'Experiencia obtenida'],
                'opcion' => 'table',
                'titulo' => 'Tabla de Actividades Terminadas ya revisados',
                'ajaxroute' => 'ss.ssActividadT',
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }
    public function tabla_actividades_canceladas()
    {

        $columns = array(
            ["data" => "id_actividad", "visible" => false],
            ["data" => "asignado_a"],
            ["data" => "nombre_act"],
            ["data" => "tipo_categoria"],
            ["data" => "tipo_actividad"],
            ["data" => "descripcion", "visible" => false, "sortable" => false],
            ["data" => "objetivo", "visible" => false, "sortable" => false],
            ["data" => "fecha"],
            ["data" => "estimacion_tiempo"],
            ["data" => "nota"],
            ["data" => "acciones", "sortable" => false]

        );
        return view(
            '/admin/homeA',
            [
                'datos' => ['id_actividad', 'Prestador', 'Nombre act.', 'Tipo categoria', 'Tipo act.', 'Descripcion', 'Objetivo', 'Fecha', 'Estimacion tiempo', 'Nota', 'Acciones'],
                'opcion' => 'table',
                'titulo' => 'Tabla de Actividades canceladas por prestador',
                'ajaxroute' => 'ss.ssActividadCanceladas',
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }

    public function actividades_en_progreso()
    {
        $columns = array(
            ["data" => "id_actividad", "visible" => false],
            ["data" => "asignado_a"],
            ["data" => "nombre_act"],
            ["data" => "tipo_categoria"],
            ["data" => "tipo_actividad"],
            ["data" => "descripcion", "sortable" => false],
            ["data" => "objetivo", "sortable" => false],
            ["data" => "fecha"],
            ["data" => "estimacion_tiempo"],
            ["data" => "acciones", "sortable" => false]
        );
        return view(
            '/admin/homeA',
            [
                'datos' => ['id_actividad', 'Prestador', 'Nombre act.', 'Tipo categoria', 'Tipo act.', 'Descripcion', 'Objetivo', 'Fecha', 'Estimacion tiempo', 'Acciones'],
                'opcion' => 'table',
                'titulo' => 'Tabla de Actividades en proceso',
                'ajaxroute' => 'ss.ssActividadProgreso',
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }

    public function actividad_modificar(Request $request)
    {
        $id = $request->input('id');
        $actividad = DB::table('actividad_tabla')->where('id_actcreada', $id)->get();
        $actividad2 = DB::table('actividades_prestadores')->where('llave_Actividad', $id)->get();
        $prestadores = DB::table('soloprestadores')
            ->where('tipo', 'prestador')
            ->where('coordinador_id', auth()->user()->id)
            ->get();
        $actividades = DB::table('actividades')->get(); // obtener las actividades de la tabla
        $categorias = DB::table('categorias')->get();

        // echo "<script> alert(JSON.stringify($actividad2)); </script>";
        return view(
            '//admin/homeA',
            [
                'id_actividad' => $id,
                'prestadores' => $prestadores,
                'tipo' => 'modificar',
                'llaves' => $actividad2,
                'actm' => $actividad,
                'categorias' => $categorias,
                'actividades' => $actividades,
                'opcion' => 'C_Actividades'
            ]
        );
    }

    public function actividad_cancelada(Request $request)
    {
        $id = $request->input('id');
        $actividad = DB::table('actividad_tabla')->where('id_actcreada', $id)->get();
        $actividad2 = DB::table('actividades_prestadores')->where('llave_Actividad', $id)->get();
        $prestadores = DB::table('soloprestadores')
            ->where('tipo', 'prestador')
            ->where('coordinador_id', auth()->user()->id)
            ->get();
        $actividades = DB::table('actividades')->get(); // obtener las actividades de la tabla
        $categorias = DB::table('categorias')->get();

        return view(
            '//admin/homeA',
            [
                'id_actividad' => $id,
                'prestadores' => $prestadores,
                'tipo' => 'canceladas',
                'llaves' => $actividad2,
                'actm' => $actividad,
                'categorias' => $categorias,
                'actividades' => $actividades,
                'opcion' => 'C_Actividades_canceladas'
            ]
        );
    }

    public function participantes(Request $request)
    {
        $id = $request->input('idact');

        $actividad = DB::table('actividad_tabla')->where('id_actcreada', $id)->get();

        return view(
            '/admin/homeA',
            [
                'actividades' => $actividad,
                "opcion" => 'Participantes_act'
            ]
        );
    }

    public function adminUpdate(Request $request)
    {
        $id = $request->input('id');
        $validation = $this->validator($request->all(), $id);
        if ($validation->fails()) {
            return redirect('/admin/modificar?id=' . $id)->withInput()->withErrors($validation->errors());
        } else {
            $input = $request->all();
            $usuario = User::findOrFail($id);

            $input['password'] =  Hash::make($input['password']);
            $usuario->fill($input)->save();

            if ($usuario->tipo == "clientes" && !DB::table('clientes')->where('id', $id)->exists()) {

                $crear = DB::table('clientes')->insert(
                    [
                        'id' => $id,
                        'codigo' => $usuario->codigo,
                        'nombre' => $usuario->name,
                    ]
                );
            }
            if (DB::table('clientes')->where('id', $id)->exists()) {
                $crear = DB::table('clientes')->where('id', $id)->update(
                    [
                        'id' => $id,
                        'codigo' => $usuario->codigo,
                        'nombre' => $usuario->name,
                    ]
                );
            }
            return redirect()->route($this->rutaRegreso($request->input('TipoOriginal')))->with('success', 'Modificado correctamente');
        }
    }

    public function cita_programar(Request $request)
    {
        $id_citas = intval($request->input('id_citas'));
        // $id=$request->input('duallistbox_demo1');
        // $fecha=$request->input('fechacita');
        // if($request->input('status') != "solicitud_aceptada"){
        $modificar = cita_cliente::where("id_citas", "=", $id_citas)->firstOrFail();
        if ($modificar) {
            $modificar = DB::table('cita_clientes')->where('id_citas', $id_citas)->update(['status' => "solicitud_aceptada"]);
        }
        // foreach($id as $item)
        // {
        //     $insertar = DB::table('proyectos_prestadores')->insert(['id_proyecto'=>$id_citas, 'id_prestador'=>$item]);
        // }

        //     }else{
        //       $modificar = DB::table('cita_clientes')->where('id_citas',$id_citas)->update(['status' =>"solicitud_aceptada", 'fechacita'=> $fecha]);

        //       $eliminar = DB::table('proyectos_prestadores')->where('id_proyecto',"=",$id_citas)->delete();

        //       foreach($id as $item)
        //      {
        //           $insertar = DB::table('proyectos_prestadores')->insert(['id_proyecto'=>$id_citas, 'id_prestador'=>$item]);
        //     }

        //   }

        // $email = $request->input('correo');

        // $mailData = [

        //     'receptor' => $email,
        //     'asunto' => 'Solicitud exitosa!',
        //     //'id_citas' => $request->input('id_citas'),
        //     'proyecto' => $request->input('proyecto'),
        //     'despedida' => 'no pus espere jaja lol',
        //     'vista' => 'email.impresionMail',
        //     'nombre'=>$request->input('nombre'),
        //     'title' => 'Solicitud Aceptada',
        //     'body' => 'Tu solicitud a sido aceptada, por favor agenda tu cita en el menu principal.'
        // ];

        //  $correo = new MailController($mailData);
        //  $correo->sendEmail();


        return redirect()->route($this->rutaRegreso("proyecto"))->with('success', 'Aceptado correctamente');
    }

    public function cita_programar_2(Request $request)
    {


        $id_citas = intval($request->input('id_citas'));
        $id = $request->input('duallistbox_demo1');
        $fecha = $request->input('fechacita');

        $modificar = cita_cliente::where("id_citas", "=", $id_citas)->firstOrFail();
        if ($modificar) {

            $modificar = DB::table('cita_clientes')->where('id_citas', $id_citas)->update(['status' => "cita_aceptada", 'fechacita' => $fecha]);
        }

        $email = $request->input('correo');

        // $mailData = [

        //     'receptor' => $email,
        //     'asunto' => 'Solicitud exitosa!',
        //     'id_citas' => $request->input('id_citas'),
        //     'proyecto' => $request->input('proyecto'),
        //     'despedida' => 'no pus espere jaja lol',
        //     'vista' => 'email.impresionMail',
        //     'nombre'=>$request->input('nombre'),
        //     'title' => 'Solicitud Aceptada',
        //     'body' => 'Tu solicitud a sido aceptada, por favor agenda tu cita en el menu principal.'
        // ];

        //  $correo = new MailController($mailData);
        //  $correo->sendEmail();


        return redirect()->route($this->rutaRegreso("proyecto"))->with('success', 'Aceptado correctamente');
    }

    public function cita_programar_3(Request $request)
    {


        $id_citas = intval($request->input('id_citas'));
        $id = $request->input('duallistbox_demo1');


        foreach ($id as $item) {
            $insertar = DB::table('proyectos_prestadores')->insert(['id_proyecto' => $id_citas, 'id_prestador' => $item]);
        }

        $modificar = DB::table('cita_clientes')->where('id_citas', $id_citas)->update(['status' => "impresion_marcha"]);


        return redirect()->route($this->rutaRegreso("proyecto"))->with('success', 'Aceptado correctamente');
    }


    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $opcion = $request->input('opcion');
        // echo "<script> alert(JSON.stringify($id)); </script>";
        try {

            switch ($opcion) {
                case 'usuario':
                    $eliminar = DB::table('users')->where('id', $id)->delete();
                    if (DB::table('clientes')->where('id', $id)->exists()) {
                        $eliminar2 = DB::table('clientes')->where('id', $id)->delete();
                    }
                    break;
                case 'horas':
                    if (Auth::user()->tipo == "Superadmin") {
                        if (DB::table('horasprestadores')->where('id', $id)->exists()) {
                            $eliminar2 = DB::table('horasprestadores')->where('id', $id)->delete();
                        }
                    }
                    break;
                case 'proyecto':
                    if (DB::table('cita_clientes')->where('id_citas', $id)->exists()) {
                        // $proyecto = DB::table('cita_clientes')->where('id_citas',$id)->get();
                        // File::delete(public_path().'/img/credencial/'.$proyecto[0]->credencial,public_path().'/img/archivo/'. $proyecto[0]->ArchivoSTL,public_path().'/img/render/'. $proyecto[0]->render);
                        $eliminar2 = DB::table('cita_clientes')->where('id_citas', $id)->delete();
                        $eliminar3 = DB::table('proyectos_prestadores')->where('id_proyecto', "=", $id)->delete();
                    }
                    break;
                case 'actividades':
                    if (DB::table('c_actividad')->where('id_actividad', $id)->exists()) {
                        $eliminar2 = DB::table('c_actividad')->where('id_actividad', $id)->delete();
                        $eliminar3 = DB::table('actividades_prestadores')->where('llave_actividad', $id)->delete();
                    }
                    break;
                case 'visitas':
                    if (DB::table('visitas')->where('id', $id)->exists()) {
                        $eliminar2 = DB::table('visitas')->where('id', $id)->delete();
                    }
                    break;
                case 'impresion':
                    if (DB::table('cita_clientes')->where('id_citas', $id)->exists()) {
                        $eliminar2 = DB::table('cita_clientes')->where('id_citas', $id)->delete();
                        $eliminar3 = DB::table('proyectos_prestadores')->where('id_proyecto', $id)->delete();
                    }
                    break;
            }

            return redirect()->route($this->rutaRegreso($request->input('TipoOriginal')))->with('success', 'Eliminado correctamente');
        } catch (\Throwable $th) {
            return redirect()->route($this->rutaRegreso($request->input('TipoOriginal')))->with('error', $th->getMessage());
        }
    }

    public function rutaRegreso($tipoOriginal)
    {
        switch ($tipoOriginal) {
            case 'prestador':
                return 'admin.prestadores';
                break;
            case 'clientes':
                return 'admin.clientes';
                break;
            case 'proyecto':
                return 'admin.citas';
                break;
            case 'visitas':
                return 'admin.visitas';
                break;
            case 'admin':
                return 'admin.administradores';
                break;
            case 'general':
                return 'admin.general';
                break;
            default:
                return 'admin./admin/homeA';
                break;
        }
    }

    public function validator(array $data, $id)
    {

        switch ($data['tipo']) {
            case 'prestador':
                $rHoras =  ['required'];
                $rCarrera = ['required', 'string'];
                $rCodigo = ['required', 'string', 'unique:users,codigo,' . $id];

                break;
            case 'clientes':
                switch ($data['tipo_cliente']) {
                    case 'Alumno':
                    case 'Maestro':
                        $rHoras =  ['nullable'];
                        $rCarrera = ['required', 'string'];
                        $rCodigo = ['required', 'string', 'unique:users,codigo,' . $id];
                        break;
                    case 'Otro':
                        $rHoras =  ['nullable'];
                        $rCarrera = ['nullable'];
                        $rCodigo = ['nullable'];
                }
                break;
            case 'admin':
                $rHoras =  ['nullable'];
                $rCarrera = ['nullable'];
                $rCodigo = ['nullable'];
                break;
        }
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'codigo' => $rCodigo,
            'tipo' => ['required', 'string'],
            'correo' => ['required', 'email', 'unique:users,correo,' . $id],
            'horas' => $rHoras,
            'carrera' => $rCarrera,


        ]);
    }



    public function validator_premios(array $data)
    {
        switch ($data['tipo']) {
            case 'horas':
                $rHoras =  ['required'];

                break;
            case 'otro':
                $rHoras =  ['nullable'];
                break;
        }
        return Validator::make($data, [

            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['required', 'string', 'max:255'],
            'tipo' => ['required'],
            'horas' => $rHoras,
        ]);
    }


    protected function create_premios(Request $request)
    {


        $validation = $this->validator_premios($request->all());

        if ($validation->fails()) {
            var_dump($validation->errors());
            return redirect('/admin/recompensasRegistro')->withInput()->withErrors($validation->errors());
        }

        switch ($request['tipo']) {
            case 'horas':

                $horas = $request['horas'];

                break;
            case 'otro':
                $horas = null;
                break;
        }
        return premio::create([

            'nombre' => $request['nombre'],
            'descripcion' => $request['descripcion'],
            'tipo' => $request['tipo'],
            'horas' => $horas
        ]);
    }

    public function prestadoresProyectos()
    {
        $columns = array(

            ["data" => "id_citas", "visible" => false],

            ["data" => "nombre"],
            ["data" => "correo"],
            ["data" => "proyecto"],
            ["data" => "enlaceDrive"],
            ["data" => "acciones"]

        );

        return view(
            '/admin/homeA',
            [
                'datos' => [
                    "id",
                    "Nombre del Cliente",
                    "Correo",
                    "Nombre del Proyecto",
                    "Enlace Drive",
                    "Acciones"
                ],
                'opcion' => 'table',
                'titulo' => 'Tabla Impresiones-Prestadores en proceso',
                'ajaxroute' => 'ss.ssPrestadoresProyectos',
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }

    public function prestadoresProyectos2()
    {
        $columns = array(
            ["data" => "id_citas", "visible" => false],

            ["data" => "nombre"],
            ["data" => "correo"],
            ["data" => "proyecto"],
            ["data" => "enlaceDrive"],
            ["data" => "acciones"]

        );

        return view(
            '/admin/homeA',
            [
                'datos' => [
                    "id",
                    "Nombre del Cliente",
                    "Correo",
                    "Nombre del Proyecto",
                    "Enlace Drive",
                    "Acciones"
                ],
                'opcion' => 'table',
                'titulo' => 'Tabla Impresiones-Prestadores Terminadas',
                'ajaxroute' => 'ss.ssPrestadoresProyectosTerminados',
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }

    public function prestadoresProyectos3()
    {
        $columns = array(
            ["data" => "id_citas", "visible" => false],

            ["data" => "nombre"],
            ["data" => "correo"],
            ["data" => "proyecto"],
            ["data" => "enlaceDrive"],
            ["data" => "acciones"]

        );

        return view(
            '/admin/homeA',
            [
                'datos' => [
                    "id",
                    "Nombre del Cliente",
                    "Correo",
                    "Nombre del Proyecto",
                    "Enlace Drive",
                    "Acciones"
                ],
                'opcion' => 'table',
                'titulo' => 'Tabla Impresiones-Prestadores Completadas',
                'ajaxroute' => 'ss.ssPrestadoresProyectosTerminados2',
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }


    public function ProyectosCitados()
    {
        $columns = array(
            ["data" => "id", "visible" => false],
            ["data" => "proyecto"],
            ["data" => "nombre"],
            ["data" => "telefono"],
            ["data" => "carrera"],
            ["data" => "fechacita"],
            ["data" => "acciones"],
            ["data" => "eliminar"],



        );

        return view(
            '/admin/homeA',
            [
                'datos' => [
                    "id",
                    "Nombre del Proyecto",
                    "Cliente",
                    "telefono",
                    "Carrera",
                    "Cita",
                    "Acciones",
                    "eliminar",

                ],
                'opcion' => 'table',
                'titulo' => 'Cita de solicitante de impresiones ',
                'ajaxroute' => 'ss.ssProyectosCitados',
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }



    public function documento(Request $request)
    {

        $id_impresion =   $request->id_impresion;
        $titulo_proyecto =   $request->titulo_proyecto;
        $n_piezas =   $request->n_piezas;
        $nombre_cliente =   $request->nombre_cliente;

        try {
            $template = new \PhpOffice\PhpWord\TemplateProcessor('template/AVISO DE CONFORMIDAD.docx');
            $template->setValue('titulo_proyecto', $titulo_proyecto);
            $template->setValue('n_piezas', $n_piezas);
            $template->setValue('nombre_cliente', $nombre_cliente);

            $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
            $template->saveAs($tempFile);

            $headers = [
                "Content-Type: application/octet-stream",
            ];
            return response()->download($tempFile, 'documento.docx', $headers)->deleteFileAfterSend(true);
        } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
            return back($e->getCode());
        }
        return redirect()->route("admin.prestadoresProyectos");
    }

    public function denegar_impresion(Request $request)
    {

        $id_impresion =   $request->id_impresion;
        $id_impresion_prestador =  $request->id_impresion_prestador;

        $modificar = DB::table('proyectos_prestadores')->where('id_proyecto', $id_impresion)->update(
            ['status' => 'en proceso']
        );

        $modificar = DB::table('cita_clientes')->where('id_citas', $id_impresion)->update(
            ['status' => 'impresion_marcha']
        );

        return redirect()->route("admin.prestadoresProyectos");
    }


    public function eliminar_prestadores_impresion(Request $request)
    {

        $id_impresion =   $request->id_impresion;
        $id_impresion_prestador =  $request->id_impresion_prestador;

        $modificar = DB::table('proyectos_prestadores')->where('id_proyecto', $id_impresion)->delete();

        $modificar = DB::table('cita_clientes')->where('id_citas', $id_impresion)->update(
            ['status' => 'cita_aceptada']
        );

        return redirect()->route("admin.prestadoresProyectos");
    }


    public function prestadores_asignados(Request $request)
    {
        //$id=$request->input('id');
        //error_log('message here.');
        //var_dump($request->ids);

        foreach ($request->ids as $item) {
            $insertar = DB::table('proyectos_prestadores')->insert(['id_prestador' => $item, 'id_proyecto' => $request->id_proyecto]);
        }
    }

    public function faltas()
    {
        $columns = array(
            ["data" => "nombre"],
            ["data" => "apellido"],
            ["data" => "correo"],
            ["data" => "fecha"],
        );

        return view(
            '/admin/homeA',
            [
                'datos' => ['nombre', 'apellido', 'correo', 'fecha'],
                'opcion' => 'table',
                'titulo' => 'Tabla Faltas',
                'ajaxroute' => 'ss.ssFaltas',
                "columnas" => json_encode($columns),
            ]
        );
    }

    public function horario_guardar_admin(Request $request)
    {
        $horario = $request->input('horario');
        $id = $request->input('id');


        // echo "<script> alert(JSON.stringify($id)); </script>";
        $modificar = DB::table('users')->where('id', $id)->update(['horario' => $horario]);

        return redirect('/admin/prestadores');
    }

    public function veractividades(Request $request)
    {

        $nombre = $request->input('nombre');
        $id = $request->input('id');

        $columns = array(
            ["data" => "llave_actividad", "visible" => false],
            ["data" => "nombre_act"],
            ["data" => "tipo_act"],
            ["data" => "descripcion", "visible" => false, "sortable" => false],
            ["data" => "objetivo", "visible" => false, "sortable" => false],
            ["data" => "fecha"],
            ["data" => "status"],
            ["data" => "acciones", "sortable" => false]
        );
        return view(
            '/admin/homeA',
            [
                'datos' => ['id_actividad', 'nombre', 'tipo de actividades', 'descripcion', 'objetivo', 'fecha', 'status', 'acciones'],
                'opcion' => 'table2',
                'titulo' => 'Tabla de Actividades Terminadas de ' . $nombre . " ID: " . $id,
                'ajaxroute' => 'ss.ssActividadT_personal',
                'id' => $id,
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }

    public function veractividades_pendientes(Request $request)
    {

        $nombre = $request->input('nombre');
        $id = $request->input('id');

        $columns = array(
            ["data" => "llave_actividad", "visible" => false],
            ["data" => "nombre_act"],
            ["data" => "tipo_act"],
            ["data" => "descripcion", "visible" => false, "sortable" => false],
            ["data" => "objetivo", "visible" => false, "sortable" => false],
            ["data" => "fecha"],
            ["data" => "status"],
            ["data" => "acciones", "sortable" => false]
        );
        return view(
            '/admin/homeA',
            [
                'datos' => ['id_actividad', 'nombre', 'tipo de actividades', 'descripcion', 'objetivo', 'fecha', 'status', 'acciones'],
                'opcion' => 'table2',
                'titulo' => 'Tabla de Actividades Pendientes de ' . $nombre . " ID: " . $id,
                'ajaxroute' => 'ss.ssActividadP_personal',
                'id' => $id,
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }

    public function veractividades_completadas(Request $request)
    {

        $nombre = $request->input('nombre');
        $id = $request->input('id');

        $columns = array(
            ["data" => "llave_actividad", "visible" => false],
            ["data" => "nombre_act"],
            ["data" => "tipo_act"],
            ["data" => "descripcion", "visible" => false, "sortable" => false],
            ["data" => "objetivo", "visible" => false, "sortable" => false],
            ["data" => "fecha"],
            ["data" => "status"],
            ["data" => "acciones", "sortable" => false]
        );
        return view(
            '/admin/homeA',
            [
                'datos' => ['id_actividad', 'nombre', 'tipo de actividades', 'descripcion', 'objetivo', 'fecha', 'status', 'acciones'],
                'opcion' => 'table2',
                'titulo' => 'Tabla de Actividades Pendientes de ' . $nombre . " ID: " . $id,
                'ajaxroute' => 'ss.ssActividadR_personal',
                'id' => $id,
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }

    public function horarios(Request $request)
    {
        $columns = array(
            ["data" => "Id"],
            ["data" => "descripcion"],
            ["data" => "diasHorario", "sortable" => false],
            ["data" => "acciones", "sortable" => false]
        );
        return view(
            '/admin/homeA',
            [
                'datos' => ['Id', 'descripcion', 'dias', 'acciones'],
                'opcion' => 'tableHorario',
                'titulo' => 'Tabla de horarios',
                'ajaxroute' => 'ss.sshorario',
                "columnas" => json_encode($columns),
                'button' => false,
                'accion' => false,
                'cursos' => false,
                'descarga' => false,
            ]
        );
    }
    public function guardarhorario(Request $request)
    {
        $modificar = DB::table('horarios')->insert(
            [
                'descripcion' => $request->input('horario'),
                'lunes' => $request->input('lunes'),
                'martes' => $request->input('martes'),
                'miercoles' => $request->input('miercoles'),
                'jueves' => $request->input('jueves'),
                'viernes' => $request->input('viernes'),
                'sabado' => $request->input('sabado'),
                'domingo' => $request->input('domingo')
            ]
        );
        return redirect()->route('admin.horarios');
    }
    public function eliminarhorario(Request $request)
    {
        $modificar = DB::table('horarios')->where('id', $request->input('idEliminar'))->delete();
        return redirect()->route('admin.horarios');
    }

    public function actividadDetalles($id)
    {
        $actividad = DB::table('c_actividad')
            ->select(
                'c_actividad.*',
                DB::raw("CONCAT(c_users.name, ' ', c_users.apellido) AS creada_por"),
                DB::raw("CONCAT(a_users.name, ' ', a_users.apellido) AS asignado_a"),
                'actividades.nombre AS nombre_actividad',
                'actividades.horas AS horas_actividad',
                'categorias.nombre AS nombre_categoria'
            )
            ->join('users AS c_users', 'c_users.id', '=', 'c_actividad.creacion_id')
            ->join('users AS a_users', 'a_users.id', '=', 'c_actividad.asignado_a')
            ->join('actividades', 'actividades.id', '=', 'c_actividad.acti_id') // unir la tabla 'actividades'
            ->join('categorias', 'categorias.id', '=', 'actividades.categoria_id') // unir la tabla 'categorias'
            ->where('id_actividad', $id)
            ->first();

        if ($actividad === null) {
            abort(404);
        }

        $actividad_hora = DB::table('actividades')
            ->where('id', $actividad->acti_id)
            ->value('horas');

        // verificar si la actividad está en estado "finalizada"
        if ($actividad->status == "terminado") {
            // evaluar la experiencia y asignar los puntos
            $teu = $actividad->estimacion_tiempo; //tiempo estimado del usuario
            $tec = $actividad_hora; //tiempo estimado de clasificacion
            $duracion = $actividad->duracion; //duracion de la actividad (fecha fin - fecha inicio)

            // Convertir los valores de tiempo en segundos
            $teu_segundos = strtotime($teu) - strtotime('00:00:00');
            $tec_segundos = strtotime($tec) - strtotime('00:00:00');

            // Sumar los valores de tiempo en segundos
            $total_segundos = $teu_segundos + $tec_segundos;


            // Convertir los segundos en formato "HH:MM:SS"
            $tt = gmdate("H:i:s", $total_segundos); //tiempo de tolerancia

            // Calcular el tiempo compromiso
            $tc_segundos = ($total_segundos) / 2;
            $tc = gmdate("H:i:s", $tc_segundos); //tiempo compromisp


            if ($teu < $tec) {
                $mt = $teu;
            } else {
                $mt = $tec;
            }


            // if ($duracion < $mt) {
            //     $experiencia = 10;
            // } else if ($tc < $mt) {
            //     $experiencia = 8;
            // } else if ($duracion > $teu && $duracion <= $tt) {
            //     $experiencia = 50;
            // } else {
            //     $experiencia = -50;
            // }

            // NUEVAS VALIDACIONES Y ASIGNACION DE EXPERIENCIA:
            if ($duracion < $mt) {
                $experiencia = 10; // Terminada antes MT (MT-Menor tiempo)
            } else if ($duracion < $tc && $duracion > $mt) {
                $experiencia = 8; // Terminada antes TC pero después del menor tiempo (MT)
            } else if ($duracion > $tc && $duracion < $teu && $duracion < $tt) {
                $experiencia = 5; // Termina después TC pero antes de mayor tiempo (TEU o TEC)
            } else if (($duracion > $teu || $duracion > $tec) && $duracion < $tt) {
                $experiencia = 3; // Termina después de mayor tiempo (TEU o TEC) pero antes de tolerancia TT
            } else {
                $experiencia = -3; // No terminada en tiempo de tolerancia TT
            }
        }

        return view('actividadDetalles', ['actividad' => $actividad, 'experiencia' => $experiencia]);
    }

    public function actividadRevisada($id_actividad, $experiencia)
    {
        // actualizar el estado de la actividad
        $actividad = DB::table('c_actividad')->where('id_actividad', $id_actividad)->first();

        DB::table('c_actividad')
            ->where('id_actividad', $id_actividad)
            ->update(['status' => 'terminado_revisado', 'experiencia_obtenida' => $experiencia]);

        // asignar la experiencia al prestador
        $prestador = DB::table('users')->where('id', $actividad->asignado_a)->first();
        DB::table('users')->where('id', $actividad->asignado_a)->update(['experiencia' => $prestador->experiencia + $experiencia]);

        // return redirect()->route('admin/actividades_revision')->with('success', 'Actividad revisada correctamente');
        return redirect('admin/actividades_revision')->with('success', "Actividad revisada correctamente");
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
                ->where('coordinador_id', $userId)
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
                ->where('coordinador_id', $userId)
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
                ->where('coordinador_id', $userId)
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
                ->where('coordinador_id', $userId)
                ->count();
        }

        return $cantidad;
    }
    function obtenerCantidadActividadesCanceladas()
    {
        // Obtener el ID y el tipo de usuario autenticado
        $userId = Auth::id();
        $userType = Auth::user()->tipo;

        // Verificar si el usuario es "Superadmin"
        if ($userType === 'Superadmin') {
            // Si es "Superadmin", retornar la cantidad total de registros (todos)
            $cantidad = DB::table('c_actividad')
                ->where('status', 'cancelacion_prestador')
                ->count();
        } else {
            // Si no es "Superadmin", filtrar por el ID del usuario autenticado
            $cantidad = DB::table('c_actividad')
                ->where('status', 'cancelacion_prestador')
                ->where('coordinador_id', $userId)
                ->count();
        }

        return $cantidad;
    }

        /*public function index()
        {
          $users =DB::table('registros_checkin')->orderBy('id','DESC')->get();    //     return view('//admin/homeA',
             ['users'=>$users,
             'datos'=>['codigo','nombre','fecha','hora_entrada','hora_salida','tiempo'],
             'opcion'=> 'table',
             'nombre' => 'Tabla',
             'titulo'=>'Prestadores',
             'button'=>true,
             'accion'=>false,
             'cursos'=>false]);
    }

    public function registro($centros = null, $coordinador = null)
    {
         if (is_null($centros)) {
             $centros = DB::table('centros')->get();
         }

         if (is_null($coordinador)) {
             $coordinador = DB::table('users')->where('tipo', 'admin')->get();
         }

         return view('//admin/homeA', [
             'opcion' => 'auth.registerAdmin',
             'centros' => $centros,
             'coordinador' => $coordinador,
             'nombre' => 'Registro',
             'ruta' => 'registrar'
         ]);
    }


    public function horarioadmin(Request $request)
    {
        $query2 = DB::table('horarios')->get();
        $id = $request->input('id');
        $nombre = $request->input('nombre');
        $horario = $request->input('horario');
        return view('/admin/homeA', ['opcion' => 'horarioadmin', 'id_prestador' => $id, 'horario' => $horario, 'nombre' => $nombre,  'horario2' => $query2]);
    }


    public function modificar(Request $request)
    {
        $id = $request->input('id');
        $tUser = Auth::user()->tipo;
        $uModificar = User::findOrFail($id);
        $coordinadors = User::where('can_admin', true)->get();

        return view ('/auth/registerAdmin');
        if (($tUser == "Superadmin") || ($tUser == "admin" && ($uModificar->tipo != "admin" && $uModificar->tipo != "checkin" && $uModificar->tipo != "Superadmin"))) {
            $id = $request->input('id');
            $user = DB::table('users')->where('id', $id)->get();
            // $carreras = DB::table('carreras')->get();
            $centros = DB::table('centros')->get();
            return view('//admin/homeA', ['opcion' => 'auth.registerAdmin', 
                                  'centros' => $centros, 
                                  'nombre' => 'Edicion', 
                                  'dV' => $user, 
                                  'ruta' => 'admin.update', 
                                  'coordinador' => $coordinadors]);
        } else {
            return redirect('/');
        }
    }*/

}
