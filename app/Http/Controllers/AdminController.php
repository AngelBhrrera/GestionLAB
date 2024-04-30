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
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

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

    public function rendimientoAdmin(){

        $prestadores = DB::table('perfil_prestador') ->where('area', 1)->limit(10)->get();
        $np = DB::table('perfil_prestador')->where('area', 1)->get();
        
        $carreras = DB::table('perfil_prestador')
            ->select('carrera', DB::raw('COUNT(*) as conteo'))
            ->where('area', Auth::user()->area)
            ->groupBy('carrera')
            ->get();

        $turnos = DB::table('perfil_prestador')
            ->select('horario', DB::raw('COUNT(*) as conteo'))
            ->where('area', Auth::user()->area)
            ->groupBy('horario')
            ->get();
        $periodos = DB::table('perfil_prestador')
            ->select('periodo', DB::raw('COUNT(*) as conteo'))
            ->where('area', Auth::user()->area)
            ->groupBy('periodo')
            ->get();
    
        $rendimiento = DB::table('rendimiento')
            ->select('semana', 'anio', 'id_area', DB::raw('SUM(total_exp) as total_exp_sum'), DB::raw('SUM(cantidad_actividades) as cantidad_actividades_sum'))
            ->where('id_area', Auth::user()->area)
            ->groupBy('semana','anio', 'id_area')
            ->orderByDesc('semana')
            ->get();
    
        $rendimientoT = DB::table('rendimiento')
            ->where('id_area', Auth::user()->area)
            ->orderBy('fecha_reporte')
            ->get();
    
        $rendimientoTT = DB::table('rendimiento')
            ->selectRaw('semana, anio, SUM(total_exp) as total_exp_sum, SUM(cantidad_actividades) as cantidad_actividades_sum')
            ->where('id_area', Auth::user()->area)
            ->groupBy('semana', 'anio')
            ->get();
    
        $ultimaActualizacion = DB::table('rendimiento')
            ->select('fecha_reporte')
            ->where('id_area', Auth::user()->area)
            ->orderByDesc('fecha_reporte')
            ->first();
    
        $resultadosActual = DB::select("
            SELECT 
                actividades.titulo, 
                actividades_prestadores.fecha, 
                actividades_prestadores.exp, 
                actividades.exp_ref,
                actividades_prestadores.estado,
                CASE 
                    WHEN actividades_prestadores.exp >= 0.8 * actividades.exp_ref THEN 1 
                    ELSE 0 
                END AS comparacion_exp
            FROM 
                actividades_prestadores 
            JOIN 
                actividades ON actividades_prestadores.id_actividad = actividades.id 
            WHERE 
                WEEK(actividades_prestadores.fecha) = ? 
                AND YEAR(actividades_prestadores.fecha) = ?
        ", [$rendimiento[0]->semana, $rendimiento[0]->anio]);
    
        $todosRA = count($resultadosActual);
    
        $notablesRA = 0;
        foreach ($resultadosActual as $resultado) {
            if ($resultado->comparacion_exp == 1) {
                $notablesRA++;
            }
        }
        $acabadasRA = 0;
        foreach ($resultadosActual as $resultado) {
            if ($resultado->estado == 'Aprobada') {
                $acabadasRA++;
            }
        }
        $porcentajeA = $notablesRA * 100 / $todosRA;
    
        $resultadosPrevio = DB::select("
            SELECT 
                actividades.titulo, 
                actividades_prestadores.fecha, 
                actividades_prestadores.exp, 
                actividades.exp_ref,
                actividades_prestadores.estado,
                CASE 
                    WHEN actividades_prestadores.exp >= 0.8 * actividades.exp_ref THEN 1 
                    ELSE 0 
                END AS comparacion_exp
            FROM 
                actividades_prestadores 
            JOIN 
                actividades ON actividades_prestadores.id_actividad = actividades.id 
            WHERE 
                WEEK(actividades_prestadores.fecha) = ? 
                AND YEAR(actividades_prestadores.fecha) = ?
        ", [$rendimiento[1]->semana, $rendimiento[1]->anio]);
    
        
        $todosRP = count($resultadosPrevio);
    
        $notablesRP = 0;
        foreach ($resultadosPrevio as $resultado) {
            if ($resultado->comparacion_exp == 1) {
                $notablesRP++;
            }
        }
        $acabadasRP = 0;
        foreach ($resultadosPrevio as $resultado) {
            if ($resultado->estado == 'Aprobada') {
                $acabadasRP++;
            }
        }
        $porcentajeP = ($notablesRP * 100) / $todosRP;
    
        return view('homePredictionDB', compact('prestadores', 'carreras', 'turnos', 'periodos','np', 
        'rendimiento', 'rendimientoT', 'acabadasRA', 'acabadasRP', 'porcentajeA', 'porcentajeP',
        'ultimaActualizacion', 'rendimientoTT'));
    }

    public function dataframe(){

        $resultados = DB::table('datosML')
            ->get();
        return view('dataFrame', ['data' => json_encode($resultados)]);
    }

    public function predictor(){
        $prestadores = DB::table('solo_prestadores')
            ->where('id_area', Auth::user()->area)
            ->get();
        $actividades = DB::table('actividades')
            ->whereNotNull('TEC')
            ->get();
    
        return view('testApi', compact('prestadores', 'actividades'));
    }

    public function home(){

        $sqlproy = DB::table('proyectos as p')
            ->join('areas as a', 'p.id_area', '=', 'a.id')
            ->where('p.estado', '==', 'finalizado');
        $sqlactsp  =DB::table('actividades_prestadores as ap')
            ->select('ap.id')
            ->join('users as u', 'ap.id_prestador', '=', 'u.id')
            ->whereNotIn('estado', ['Creada','Aprobada', 'Asignada']);
        $sqlactst = DB::table('actividades_prestadores as ap')
            ->select('ap.id')
            ->join('users as u', 'ap.id_prestador', '=', 'u.id')
            ->where('ap.estado', 'Aprobada');
        $totalExp = DB::table('lb_w as w') 
            ->join('users as u', 'w.id_prestador', '=', 'u.id');

        if(Auth::user()->tipo == 'jefe sede' ){
            $sqlproy->where('a.id_sede', Auth::user()->horario);
            $sqlactsp ->where('u.sede', Auth::user()->sede);
            $sqlactst ->where('u.sede', Auth::user()->sede);
            $totalExp->where('w.id_sede', Auth::user()->sede);
        }  
        if(Auth::user()->tipo == 'coordinador' || Auth::user()->tipo == 'jefe area' ){
            $sqlproy->where('p.id_area', Auth::user()->area);
            $sqlactsp ->where('u.area', Auth::user()->area);
            $sqlactst ->where('u.area', Auth::user()->area);
            $totalExp->where('w.id_area', Auth::user()->area);
        }
        if(Auth::user()->horario != 'No Aplica'){
            $sqlproy->where('p.turno', Auth::user()->horario);
            $sqlactsp->where('u.horario', Auth::user()->horario);
            $sqlactst->where('u.horario', Auth::user()->horario);
            $totalExp->where('u.horario', Auth::user()->horario);
        }
        //$sqlproy = $sqlproy->get();

        $proys = $sqlproy->count();
        $actsP = $sqlactsp->count();
        $actsT = $sqlactst->count();
        $totalExp = $totalExp->sum('total_exp');

        $exp = strval($totalExp);

        $rendimiento =  DB::table('rendimiento')
            ->where('id_usuario', auth()->user()->id )
            ->get();

        return view("admin/homeA",compact('proys','actsP','actsT','exp'));
    }

    public function firmas(){
        $sql = DB::table('registros_checkin as r')
            ->select('r.*', 'u.codigo')
            ->join('users as u', 'r.idusuario', '=', 'u.id')
            ->orderBy('fecha_actual', 'desc');

        if(Auth::user()->tipo == "jefe sede"){
            $sql->where('u.sede', Auth::user()->sede);
        }else{
            $sql->where('u.area', Auth::user()->area);
        }
        $sql = $sql->get();

        if(Auth::user()->tipo == "coordinador"){
            return view("admin.ver_asistencias_encargado", ['datos' => json_encode($sql)]);
        }else{
            return view("admin.ver_asistencias_admin", ['datos' => json_encode($sql)]);
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

    //ADMINISTRADOR DE PRESTADORES / VOLUNTARIOS / PRACTICANTES

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
            $users[] = ['id' => "RBadminsede", 'value' => 'jefe sede', 'name' => 'Jefe de sede'];
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
        
        $dataP = DB::table('solo_prestadores');
        $dataA = DB::table('solo_admins');
        $data = DB::table('users')
            ->select('users.id','users.name', 'users.apellido', 'users.correo', 'users.codigo', 'users.tipo', 'users.telefono', 'areas.nombre_area')
            ->join('areas', 'users.area', '=', 'areas.id');
        $areas = null;
        $sedes = null;
        
        if (auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area') {
            $data->where('users.area', auth()->user()->area);
            $n_Area = DB::table('areas')
            ->where('id', auth()->user()->area)
            ->value('nombre_area');
            $dataA->where('solo_admins.area',$n_Area);
            $dataP->where('id_area', Auth::user()->area);
            $horarios= DB::table('areas')->where('id', Auth::user()->area)->first();
            $horariosValidos = [];
            $horariosValidos[] = ($horarios->turnoMatutino == 1) ? "Matutino": null;
            $horariosValidos[] = ($horarios->turnoMediodia == 1) ? "Mediodia": null;
            $horariosValidos[] = ($horarios->turnoVespertino == 1) ? "Vespertino": null;
            $horariosValidos[] = ($horarios->turnoSabatino == 1) ? "Sabatino": null;
            $horariosValidos[] = ($horarios->turnoTiempoCompleto == 1) ? "TC": null;
            $horariosValidos[] = ($horarios->no_Aplica == 1) ? "No Aplica": null;
        } else if (auth()->user()->tipo == 'jefe sede') {
            $data->where('users.sede', auth()->user()->sede);
            $n_Sede = DB::table('sedes')
                ->where('id_sede', auth()->user()->sede)
                ->value('nombre_sede');
            $dataA->where('solo_admins.sede',$n_Sede);
            $dataP->where('id_sede', Auth::user()->sede);
            $horariosValidos = ["Matutino", "Vespertino", "Mediodia", "Sabatino", "TC", "No Aplica"];
            $areas = DB::table('areas')->where('id_sede', Auth::user()->sede)->get();
        }else if (auth()->user()->tipo == 'Superadmin'){
            $horariosValidos = ["Matutino", "Vespertino", "Mediodia", "Sabatino", "TC", "No Aplica"];
            $areas = DB::table('areas')->get();
            $sedes = DB::table('sedes')->get();
        }
        
        $data = $data->get();
        $dataC = DB::table('solo_prestadores')->where('tipo','coordinador')->get();
        $dataP = $dataP->get();
        $dataA = $dataA->get();
        $dataV = DB::table('solo_clientes')
            ->get();
        

        return view('admin/ver_users', ['datos' => json_encode($data), 
            'horariosValidos' => $horariosValidos, 'areas' => $areas, 'sedes' => $sedes,
            'datosA' => json_encode($dataA),
            'datosV' => json_encode($dataV),
            'datosP' => json_encode($dataP),
            'datosC' => json_encode($dataC),]);
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

        return view('admin/ver_admins', ['datos' => json_encode($data)]);
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
        $dataI = DB::table('prestadores_inactivos');
        $dataL = DB::table('prestadores_servicio_liberado');
        $dataT = DB::table('prestadores_servicio_concluido');
        $horarios = DB::Table('areas');

        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $data->where('id_area', Auth::user()->area);
            $dataI->where('area', Auth::user()->area);
            $dataL->where('area', Auth::user()->area);
            $dataT->where('area', Auth::user()->area);
            $horarios->where('id', Auth::user()->area);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $data->where('id_sede', Auth::user()->sede);
            $dataI->where('sede',  Auth::user()->sede);
            $dataL->where('sede',  Auth::user()->sede);
            $dataT->where('sede',  Auth::user()->sede);
        }

        $data = $data->get();
        $dataI = $dataI->get();
        $dataL = $dataL->get();
        $dataT = $dataT->get();
        $horarios = $horarios->first();
        $horariosValidos = [];
        
        $horariosValidos[] = ($horarios->turnoMatutino == 1) ? "Matutino": null;
        $horariosValidos[] = ($horarios->turnoMediodia == 1) ? "Mediodia": null;
        $horariosValidos[] = ($horarios->turnoVespertino == 1) ? "Vespertino": null;
        $horariosValidos[] = ($horarios->turnoSabatino == 1) ? "Sabatino": null;
        $horariosValidos[] = ($horarios->turnoTiempoCompleto == 1) ? "TC": null;
        $horariosValidos[] = ($horarios->no_Aplica == 1) ? "No Aplica": null;

        

        return view('admin/ver_prestadores', ['datos' => json_encode($data),
        'datosI' => json_encode($dataI),   'datosL' => json_encode($dataL),
        'datosT' => json_encode($dataT), 'horariosValidos' => $horariosValidos ]);
    }

    public function prestadores_pendientes()
    {
        $data = DB::table('prestadores_pendientes');
        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $data->where('area', Auth::user()->area);
        }else if(auth()->user()->tipo == 'jefe sede'){
            $data->where('sede',  Auth::user()->sede);
        }
        $data = $data->get();

        return view('admin/ver_prestadoresPendientes', ['datos' => json_encode($data)]);
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

    public function modificar_prestador(Request $request){
        
        switch($request->tipo_prest){
            case "jefe area":
            case "jefe sede":
            case "Superadmin":
            return redirect()->route('admin.prestadores')->with('error', 'Error al modificar, no tienes los permisos necesarios');
        }
        
        $id = $request->id_prest;
        $modificar = DB::table('users')
        ->where('id', $id);

        if(Auth::user()->tipo == "jefe sede"){
            $request->validate(
                ['area_edit' => 'required',
                'horario_prest' => 'required',
                'tipo_prest' => 'required'],
                ['area_edit.required' => "Debe especificar un área de trabajo",
                'horario_prest.required' => "Debe especificar un horario"]
                
            );
            $modificar->update(['area' => json_decode($request->area_edit)->id,'horario'=>$request->horario_prest, 'tipo'=>$request->tipo_prest]);
        }else if(Auth::user()->tipo == "Superadmin"){
            $request->validate(
                ['nombre' => 'required',
                'apellido' => 'required',
                'codigo' => ['required', Rule::unique('users')->ignore($id, 'id')],
                'correo'=>['required', Rule::unique('users')->ignore($id)],
                'area_edit' => 'required',
                'horario_prest' => 'required',
                'tipo_prest' => 'required',
                'sede_edit' => 'required',
                ],
                [
                'nombre.required' => 'Nombre es obligatorio',
                'apellido.required' => 'Apellido es obligatorio',
                'codigo.required' => 'Código es obligatorio',
                'correo.required' => 'El correo es obligatorio',
                'codigo.unique' => 'Código ya existente',
                'correo.unique' => 'Correo duplicado', 
                'area_edit.required' => "Debe especificar un área de trabajo",
                'sede_edit.required' => "Debe especificar una sede",
                'horario_prest.required' => "Debe especificar un horario",
                ]
            );
            $modificar->update(['name'=>$request->nombre, 'apellido'=>$request->apellido, 
            'codigo'=>$request->codigo, 'correo' => $request->correo,
            'sede'=> $request->sede_edit, 'area' => json_decode($request->area_edit)->id,
            'horario'=>$request->horario_prest, 'tipo'=>$request->tipo_prest]);
        }else{
            $request->validate(
                [
                'horario_prest' => 'required',
                'tipo_prest' => 'required'
                ],
                [
                'horario_prest.required' => "Debe especificar un horario",]
            );
            if(Auth::user()->tipo == "coordinador"){
                $modificar = DB::table('users')
                ->where('codigo', $request->codigo)
                ->update(['horario'=>$request->horario_prest, 'tipo'=>$request->tipo_prest]);
                return redirect()->route('admin.prestadores')->with('success', 'Modificado Correctamente');
            }
            $modificar->update(['horario'=>$request->horario_prest, 'tipo'=>$request->tipo_prest]);
        }
        return redirect()->route('admin.general')->with('success', 'Modificado Correctamente');
        
    }

    public function modificar_prestador2(Request $request){
        
        switch($request->tipo_prest){
            case "jefe area":
            case "jefe sede":
            case "Superadmin":
            return redirect()->route('admin.prestadores')->with('error', 'Error al modificar, no tienes los permisos necesarios');
        }
        
        $id = $request->id_prest;
        $modificar = DB::table('users')
        ->where('id', $id);

        if(Auth::user()->tipo == "Superadmin"){
            $request->validate(
                ['nombre' => 'required',
                'apellido' => 'required',
                'codigo' => ['required', Rule::unique('users')->ignore($id, 'id')],
                'correo'=>['required', Rule::unique('users')->ignore($id)],
                ],
                [
                'nombre.required' => 'Nombre es obligatorio',
                'apellido.required' => 'Apellido es obligatorio',
                'codigo.required' => 'Código es obligatorio',
                'correo.required' => 'El correo es obligatorio',
                'codigo.unique' => 'Código ya existente',
                'correo.unique' => 'Correo duplicado', 
                ]
            );
            $modificar->update(['name'=>$request->nombre, 'apellido'=>$request->apellido, 
            'codigo'=>$request->codigo, 'correo' => $request->correo,]);
        }
        return redirect()->route('admin.general')->with('success', 'Modificado Correctamente');
        
    }

    public function modificar_password(Request $request){
        $request->validate(
            ['nuevaPassword' => 'required',
            'confirmarPassword' => 'required'],
            ['nuevaPassword.required' => 'Debe introducir una nueva contraseña',
            'confirmarPassword.required' => 'Debe confirmar la contraseña']
        );

        if($request->nuevaPassword != $request->confirmarPassword){
            return redirect()->route('admin.general')->with('warning', "Las contraseñas no coinciden");
        }

        $modificar = DB::table('users')->where('id', $request->id_prest)->update(['password' => Hash::make($request->nuevaPassword)]);

        return redirect()->route('admin.general')->with('success', "Contraseña modificada");
    }

    // ACTIVIDADES Y PROYECTOS

    public function get_aPrestadores(){
        $aPrestadores = DB::table('solo_prestadores');
    
        if( auth()->user()->tipo == 'coordinador'){
            $aPrestadores->where('id_area', auth()->user()->area)
                ->where('horario', auth()->user()->horario);
        }else if(auth()->user()->tipo == 'jefe area'){
            $aPrestadores->where('id_area', auth()->user()->area);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $aPrestadores->where('id_sede', auth()->user()->sede);
        }
        $aPrestadores = $aPrestadores->get();

        return $aPrestadores;
    }

    public function get_aProyectos(){

        $proyectos = DB::table('proyectos');
        switch(Auth::user()->tipo){
            case "coordinador":
           
                $proyectos->where('id_area', Auth::user()->area)
                ->where(function ($query) {
                    $query->where('turno', '=', Auth::user()->horario)
                        ->orWhere('turno', 'No Aplica');
                });
                break;
            case "jefe area":
                $proyectos->where('id_area', Auth::user()->area);
                break;
            case "jefe sede":
                $proyectos->join('areas', 'proyectos.id_area', '=', 'areas.id')
                    ->where('areas.id_sede', '=', Auth::user()->sede);
                break;
            default:
        }
        $proyectos = $proyectos->get();

        return $proyectos;
    }
   

    public function actividades(){

  
        $listaActs = DB::table('seguimiento_actividades');

        $reviewActs = $listaActs ->whereIn('seguimiento_actividades.estado', ['En revision', 'Error'])
            ->join('proyectos', 'seguimiento_actividades.id_proyecto', '=', 'proyectos.id')
            ->select('seguimiento_actividades.*', 'proyectos.turno');

        $pR = DB::table('actividades')
            ->whereNull('TEC');


        $prestadores = DB::table('solo_prestadores');
        $categorias = DB::table('categorias')->orderBy('nombre')->get();
        $subcategorias = DB::table('subcategorias')->orderBy('nombre')->get();
        $premios = DB::table("premios")
            ->select("id","nombre","limite")->get();

        if( auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $listaActs->whereIn('id_proyecto', function ($query) {
                $query->select('id')
                    ->from('proyectos')
                    ->where('id_area', auth()->user()->area);
            });
            $pR->where(function($query) {
                $query->where('tipo', 0)
                ->orWhere('tipo', auth()->user()->area);
            });
            $prestadores->where('id_area', auth()->user()->area)
                ->where('horario', auth()->user()->horario);
            $reviewActs->whereIn('id_proyecto', function ($query) {
                $query->select('id')
                    ->from('proyectos')
                    ->where('id_area', auth()->user()->area);
            });
            if( auth()->user()->tipo == 'coordinador'){
                $reviewActs->where(function ($query) {
                    $query->where('proyectos.turno', 'No aplica')
                          ->orWhere('proyectos.turno', auth()->user()->horario);
                });
            }
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $listaActs->whereIn('id_proyecto', function ($query) {
                $query->select('id')
                    ->from('proyectos')
                    ->whereIn('id_area', function ($subquery) {
                        $subquery->select('id_sede')
                                ->from('areas')
                                ->where('id_sede', auth()->user()->sede);
                    });
            });
            $prestadores->where('id_sede', auth()->user()->sede)
                ->where('horario', auth()->user()->horario);
            $reviewActs->whereIn('id_proyecto', function ($query) {
                $query->select('id')
                    ->from('proyectos')
                    ->whereIn('id_area', function ($subquery) {
                        $subquery->select('id_sede')
                                ->from('areas')
                                ->where('id_sede', auth()->user()->sede);
                });
            });
        }

        $listaActs = $listaActs->orderByDesc('fecha')->get();
        $pR = $pR->get();
        $reviewActs = $reviewActs->get();
        $prestadores = $prestadores->get();
        $aActividad = DB::table('actividades')
            ->whereNotNull('TEC')
            ->get();
        $aPrestador = $this->get_aPrestadores();
        $aProyectos = $this->get_aProyectos();

        $acts = DB::table('actividades')
            ->select('actividades.id', 'titulo', 'TEC' , 'exp_ref', 'descripcion', 'recursos', 'objetivos', 'categorias.nombre AS categoria', 'subcategorias.nombre AS subcategoria')
            ->join('categorias', 'id_categoria', '=', 'categorias.id')
            ->join('subcategorias', 'id_subcategoria', '=', 'subcategorias.id')
            ->get();

        $cat = DB::table('categorias')
            ->select('categorias.id', 'categorias.nombre',
                DB::raw('COALESCE(actividades.total_actividades, "No existen") AS total_actividades'),
                DB::raw('CASE WHEN subcategorias.total_subcategorias > 0 THEN subcategorias.total_subcategorias ELSE "No aplica" END AS total_subcategorias'))
            ->leftJoin(DB::raw('(SELECT id_categoria, COUNT(*) AS total_actividades FROM actividades GROUP BY id_categoria) as actividades'), 'categorias.id', '=', 'actividades.id_categoria')
            ->leftJoin(DB::raw('(SELECT categoria, COUNT(*) AS total_subcategorias FROM subcategorias GROUP BY categoria) as subcategorias'), 'categorias.id', '=', 'subcategorias.categoria')
            ->get();

        return view( 'admin/actividades', [ 'prestadores' => $prestadores,
            'categorias' => $categorias, 'subcategorias' => $subcategorias,
            'aActividades' => $aActividad,  'aProyectos' => $aProyectos,  'aPrestadores' => $aPrestador,
            'data1' =>json_encode($listaActs),
            'data2' =>json_encode($pR),
            "premios" => $premios,
            'data3' =>json_encode($reviewActs),
            'data4' =>json_encode($acts),
            'tabla_categorias' =>json_encode($cat)]);
    }

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

    /*public function actividades(){

        $data = DB::table('seguimiento_actividades');

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
        $data = $data->orderByDesc('fecha')->get();

        return view( 'admin/ver_todasActividades', [ 'data' =>json_encode($data)]);
    }*/

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
        $categorias = DB::table('categorias')->orderBy('nombre')->get();
        $subcategorias = DB::table('subcategorias')->orderBy('nombre')->get();
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

        try{
        
            $request->validate([
                'nombre' => 'string|max:255|unique:actividades,titulo',
                'tipo' => 'integer',
                'recursos' => 'string', 
                'descripcion' => 'string|max:500',
                'objetivos' => 'string',
                'exp' => 'integer|min:5|max:100',
                "premio_asignado" => "integer|nullable",
                'horas' => [
                    'integer',
                    function ($attribute, $value, $fail) use ($request) {
                        $minutos = $request->input('minutos');
                        if ($value == 0 && $minutos == 0) {
                            $fail('Las horas y los minutos no pueden ser ambos 0.');
                        }
                    }
                ],
                'minutos' => [
                    'integer',
                    function ($attribute, $value, $fail) use ($request) {
                        $horas = $request->input('horas');
                        if ($value == 0 && $horas == 0) {
                            $fail('Las horas y los minutos no pueden ser ambos 0.');
                        }
                    }
                ]
            ]);

            $subcategoria = $request->input('tipo_subcategoria');
            if($subcategoria == '')
                $subcategoria = null;
            $horas = $request->input('horas')*60;
            $minutos = $request->input('minutos');
            $tec = $horas + $minutos;
            if( $request->input('tipo_actividad') != 'generica'){
                $tipo = auth()->user()->sede;
            }else{
                $tipo = 0;
            }
        
            DB::table('actividades')->insert([
        
                'titulo' =>$request->input('nombre'),
                'id_categoria' =>  $request->input('tipo_categoria'),
                'id_subcategoria' => $subcategoria,
                'tipo' => $tipo,
                'recursos' => $request->input('recursos'),
                'descripcion' =>$request->input('descripcion'),
                'exp_ref' =>$request->input('exp'),
                'objetivos' => $request->input('resultados'),
                'id_premios' =>$request->input('premio_asignado'),
                'TEC' => $tec,]);
        
            return redirect()->back()->with('success', 'Actividad creada correctamente');
        }catch (\Exception $e) {
           
            return redirect()->back()->with('error', 'Error al crear la actividad: ' . $e->getMessage());
        }
    }

    public function makeasign_act(Request $request) {

        try{

            $request->validate([
                'nombre' => 'string|max:255|unique:actividades,titulo',
                'tipo' => 'integer',
                'recursos' => 'string', 
                'descripcion' => 'string|max:500',
                'objetivos' => 'string', 
                'exp' => 'integer|min:5|max:100',
                'premios_asignado' => 'null',
                'horas' => [
                    'integer',
                    function ($attribute, $value, $fail) use ($request) {
                        $minutos = $request->input('minutos');
                        if ($value == 0 && $minutos == 0) {
                            $fail('Las horas y los minutos no pueden ser ambos 0.');
                        }
                    }
                ],
                'minutos' => [
                    'integer',
                    function ($attribute, $value, $fail) use ($request) {
                        $horas = $request->input('horas');
                        if ($value == 0 && $horas == 0) {
                            $fail('Las horas y los minutos no pueden ser ambos 0.');
                        }
                    }
                ],
                'proyecto' => 'integer',
                'numero_veces' => 'nullable|integer|min:1|max:25',
                'tipo_asignacion' => 'integer',
                'prestadores_seleccionados' => 'array',
                'prestadores_seleccionados.*' => 'integer',
            ]);

            $subcategoria = $request->input('tipo_subcategoria');
            if($subcategoria == '')
                $subcategoria = null;
            $horas = $request->input('horas')*60;
            $minutos = $request->input('minutos');
            $tec = $horas + $minutos;
            if( $request->input('tipo_actividad') != 'generica'){
                $tipo = auth()->user()->sede;
            }else{
                $tipo = 0;
            }
        
            $idAct = DB::table('actividades')->insertGetId([
                'titulo' =>$request->input('nombre'),
                'id_categoria' =>  $request->input('tipo_categoria'),
                'id_subcategoria' => $subcategoria,
                'tipo' => $tipo,
                'recursos' => $request->input('recursos'),
                'descripcion' =>$request->input('descripcion'),
                'exp_ref' =>$request->input('exp'),
                'objetivos' => $request->input('resultados'),
                'id_premios' => $request ->input('premio_asignado'),
                'TEC' => $tec,]);

            if ($request->input('tipo_asignacion') == "1") {
                for ($i = 0; $i < $request->input('numero_veces'); $i++) {
                    DB::table('actividades_prestadores')->insert([
                        'id_prestador' => 0,
                        'id_actividad' => $idAct,
                        'estado' => "Creada",
                        'id_premios' => $request ->input('premio_asignado'),
                        'id_proyecto' => $request->input('proyecto')]);
                }
                return redirect()->back()->with('success', 'Actividad asignada correctamente');
            } else  if ($request->input('tipo_asignacion') == "2") {
                
                $prestadoresSeleccionados = $request->input('prestadores_seleccionados');
                $tamañoArreglo = count($prestadoresSeleccionados);
                for ($i = 0; $i < $tamañoArreglo; $i++) {
                    $idp = $prestadoresSeleccionados[$i];
                        DB::table('actividades_prestadores')->insert([
                            'id_prestador' => $idp,
                            'id_actividad' => $idAct,
                            'estado' => "Asignada",
                            'id_premio' => $request ->input('premio_asignado'),
                            'id_proyecto' => $request->input('proyecto')]);
                }
                return redirect()->back()->with('success', 'Actividad asignada correctamente');
            }
    
        }catch (\Exception $e) {
           
            return redirect()->back()->with('error', 'Error al crear la actividad: ' . $e->getMessage());
        }
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

        switch(Auth::user()->tipo){
            case "coordinador":
                $proyectos = DB::table('proyectos')
                ->where('id_area', Auth::user()->area)
                ->where('turno', '=', Auth::user()->horario)
                ->orWhere('turno', 'No Aplica')
                ->orWhere('particular', '0')
                ->get();
                break;
            default:
                $proyectos = DB::table('proyectos')->get();
        }
        
            
        $categorias = DB::table('categorias')->orderBy('nombre')->get();
        $actividades = DB::table('actividades')
            ->whereNotNull('TEC')
            ->get();
        
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

        DB::table('proyectos')
        ->where('id', $request->input('proyecto'))
        ->update([
            'estado' => "En desarrollo",]);

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
                        'estado' => "Asignada",
                        'id_actividad' => $request->input('tipo_actividad'),
                        'id_proyecto' => $request->input('proyecto')]);
                }else{
                    return redirect()->back()->with('error', 'Error'); 
                }
            }

            return redirect()->back()->with('success', 'Actividad asignada correctamente');

        }else{
            for ($i = 0; $i < $tamañoArreglo; $i++) {
                $idp = $prestadoresSeleccionados[$i];
                    DB::table('actividades_prestadores')->insert([
                        'id_prestador' => $idp,
                        'id_actividad' => $request->input('tipo_actividad'),
                        'estado' => "Asignada",
                        'id_proyecto' => $request->input('proyecto')]);
            }
            return redirect()->back()->with('success', 'Actividad asignada correctamente');
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

        DB::table('proyectos')
        ->where('id', $request->input('proyecto'))
        ->update([
            'estado' => "En desarrollo",]);

        return redirect(route('admin.create_proy'))->with('success', 'Asignaciones realizadas con exito');
    }

    public function asign3(Request $request){

        $request->validate([
            'proyecto' => 'integer',
            'prestadores_seleccionados' => 'required|array',
            'prestadores_seleccionados.*' => 'integer',
        ]);
            
        $prestadoresSeleccionados = $request->input('prestadores_seleccionados');
        if ($prestadoresSeleccionados != null){

            foreach ($prestadoresSeleccionados as $idp) {

                $registrado = DB::table('proyectos_prestadores')
                    ->where('id_prestador', $idp)
                    ->where('id_proyecto',  $request->input('proyecto'))
                    ->exists();

                if(!$registrado){
                    DB::table('proyectos_prestadores')->insert([
                        'id_prestador' => $idp,
                        'id_proyecto' => $request->input('proyecto')
                    ]);
                }
            }
        }

        DB::table('proyectos')
        ->where('id', $request->input('proyecto'))
        ->update([
            'estado' => "En desarrollo",]);

        return redirect(route('admin.create_proy'))->with('success', 'Prestador agregado al proyecto correctamente');
    }

    public function eliminarAct($id) {
        
        try {
            DB::table('actividades')
                ->where('id', $id)
                ->delete();   
            Session::flash('success', '¡Actividad eliminada correctamente!');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                Session::flash('warning', 'No se puede eliminar la actividad porque está siendo referenciada por otra tabla.');
            } else {
                Session::flash('error', 'Error al eliminar la actividad: ' . $e->getMessage());
            }
        }
        return redirect()->back()->with('success', 'Actividad eliminada correctamente');
    }
    
    public function modificar_categoria(Request $request){
        $request->validate(
        [
            'nombre'=>'required|unique:categorias,nombre'
        ],
        [
            'nombre.unique'=> 'Ya hay una categoría con ese nombre',
            'nombre.required'=> 'El campo nombre es obligatorio'
        ]
        );


        DB::table('categorias')->where('id',$request->id_categoria)->update(['nombre'=>$request->nombre]);

        return redirect(route('admin.categorias'))->with('success', 'Categoria modificada correctamente');
    }

    public function modificar_subCategoria(Request $request){
        
        $id = $request->id_subCategoria;
        $nombre = $request->nombreSub;
        $categoria = $request->categoria;
        
        $nombreAnterior = DB::table('subcategorias')->where('id', $id)->value('nombre');

        if(($nombreAnterior === $nombre)){
            $request->validate(
                [
                    'nombreSub'=>'required',
                    'categoria' => 'required',
                ],
                [   
                    'nombreSub.required'=> 'El campo nombre es obligatorio',
                    'categoria.required' => 'El campo categoría es obligatorio',
                ]
                );
        }else{
            $request->validate(
                [
                    'nombreSub'=>'required|unique:subcategorias,nombre',
                    'categoria' => 'required',
                ],
                [      
                    'nombreSub.unique' => 'Ya hay una subCategoría con ese nombre',
                    'nombreSub.required'=> 'El campo nombre es obligatorio',
                    'categoria.required' => 'El campo categoría es obligatorio',
                ]
                );
        }
        
        DB::table('subcategorias')->where('id', '=' ,$id)->update(['nombre'=>$nombre, 'categoria'=> $categoria]);
        

        return redirect(route('admin.categorias'))->with('success', 'Subcategoria modificada correctamente');
    }
    //PROYECTOS

    public function create_proy() {

        $tabla_proy = DB::table('seguimiento_proyecto3');
        $areas = DB::table('areas')
            ->select('id', 'nombre_area');

        if( auth()->user()->tipo == 'coordinador'){
            $areas->where('id', auth()->user()->area);
            $tabla_proy->where('id_area', auth()->user()->area);
        }else if(auth()->user()->tipo == 'jefe area'){
            $areas->where('id', auth()->user()->area);
            $tabla_proy->where('id_area', auth()->user()->area);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $areas->where('id_sede', auth()->user()->sede);
            $tabla_proy->where('id_sede', auth()->user()->sede);   
        }
        $tabla_proy =  $tabla_proy->get();
        $categorias = DB::table('categorias') ->orderBy('nombre')->get();
        $areas = $areas->get();
        $prestadores = $this->get_aPrestadores();
        $proyectos = $this->get_aProyectos();
        $prestproylist = DB::table('proyectos_prestadores')
            ->whereIn('id_proyecto', $proyectos->pluck('id'))
            ->get();
        return view('/admin/proyectos', compact('prestadores', 'areas', 'categorias', 'proyectos', 'tabla_proy','prestproylist'));
    }

    public function add_to_proys() {

        $prestadores = DB::table('solo_prestadores');
        $proyectos = DB::table('seguimiento_proyecto3')
            ->where('particular',1);

        if( auth()->user()->tipo == 'coordinador'){
            $prestadores->where('id_area', auth()->user()->area)
                ->where('horario', auth()->user()->horario)
                ->where('tipo', '!=', 'coordinador');
            $proyectos->where('id_area', auth()->user()->area)
                ->where('turno', auth()->user()->horario);
        }else if(auth()->user()->tipo == 'jefe area'){
            $prestadores->where('id_area', auth()->user()->area);
            $proyectos->where('id_area',auth()->user()->area);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $prestadores->where('id_sede', auth()->user()->sede);   
            $proyectos->where('id_sede',auth()->user()->sede); 
        }
        
        $prestadores= $prestadores->get();
        $proyectos = $proyectos->get();

        return view('/admin/registro_prestadores_proyecto', compact('prestadores', 'proyectos'));
    }

    public function add_to_proy($idP) {
        $proyectos = DB::table('seguimiento_proyecto3')
            ->select('titulo','id')
            ->where('id', $idP)
            ->get();
        $prestadores = DB::table('solo_prestadores')
                ->whereNotIn('id', function($query) use ($idP) {
                    $query->select('id_prestador')
                        ->from('proyectos_prestadores')
                        ->where('id_proyecto', $idP);
                });
        if( auth()->user()->tipo == 'coordinador'){
            $prestadores->where('id_area', auth()->user()->area)
                ->where('horario', auth()->user()->horario)
                ->where('tipo', '!=', 'coordinador');
        } else if(auth()->user()->tipo == 'jefe area'){
            $prestadores->where('id_area', auth()->user()->area);
        } else if( auth()->user()->tipo == 'jefe sede'){
            $prestadores->where('id_sede', auth()->user()->sede);   
        }
        $prestadores = $prestadores->get();
    
        return view('/admin/registro_prestadores_proyecto', compact('prestadores', 'proyectos'));
    }

    
    public function proy_acts() {
 
        $categorias = DB::table('categorias')->get();
        switch(Auth::user()->tipo){
            case "coordinador":
                $proyectos = DB::table('proyectos')
                ->where('id_area', Auth::user()->area)
                ->where('turno', '=', Auth::user()->horario)
                ->orWhere('turno', 'No Aplica')
                ->orWhere('particular', '0')
                ->get();
                break;
            default:
                $proyectos = DB::table('proyectos')->get();
        }

        return view('/admin/asignar_actividad_proyecto', compact( 'categorias', 'proyectos'));
    }

    public function make_proy(Request $request){

        $request->validate([
            'area' => 'integer',
            't_nombre' => 'unique:proyectos,titulo|string',
        ]);

        $boolp = boolval($request->input('particular'));
        if($boolp == true){
            $request->validate([
                'prestadores_seleccionados' => 'required | array',
                'prestadores_seleccionados.*' => 'integer',
            ]);
        }
        
        $idpy = DB::table('proyectos')->insertGetId([
            'titulo' => $request->t_nombre,
            'id_area' => $request->input('area'),
            'particular' => $boolp,
            'turno' => $request->input('horario'),
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

    public function view_details_proy($id){

        if(auth()->user()->tipo == 'coordinador' || auth()->user()->tipo == 'jefe area'){
            $proy = DB::table('proyectos')
                ->where('id',$id)
                ->where('id_area',auth()->user()->area)
                ->exists();
                if(!$proy){
                    return redirect(route('admin.view_proys'));
                }
        }

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
        $proyectoId = $id;

        return view('admin.ver_detalles_proyecto', compact('proyecto','prestadores', 'actividades', 'proyectoId'));
    }

    public function detail_act($id, $value) {

        $sql= DB::table('actividades_prestadores')
            ->where('id', $id)
            ->update(['detalles' => $value]);

        return response()->json(['message' => $sql]);
    }

    

    public function view_details_act($id)
    {
    
        $detalles = DB::table('actividades')
            ->select('actividades.*', 'categorias.nombre AS nombre_categoria', 'subcategorias.nombre AS nombre_subcategoria')
            ->join('categorias', 'actividades.id_categoria', '=', 'categorias.id')
            ->leftJoin('subcategorias', 'actividades.id_subcategoria', '=', 'subcategorias.id') 
            ->where('actividades.id', $id)
            ->first();

        return view('/admin/ver_detalles_actividad', [ 'detalle' => $detalles]);
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

    public function removefromProy($proyectoId, $prestadorId)
    {
        $sql = DB::table('proyectos_prestadores')->where('id_proyecto', $proyectoId)
            ->where('id_prestador', $prestadorId)
            ->delete();

        return response()->json($sql);
       
    }

    public function filtroArea($id){
       
        return  $turno = DB::table('areas')
            ->where('id', $id)
            ->get();
    }

    public function filtroEditArea($id){ //Para cambio de nombre en area
        if(Auth::user()->tipo == 'jefe area'){
            return $areas = DB::table('areas')
            ->where('id_sede', $id)
            ->where('id', Auth::user()->area)
            ->get();
        }
        
        return  $areas = DB::table('areas')
            ->where('id_sede', $id)
            ->get();
    }

    public function obtenerHorarios($id){
        $horarios = DB::table('areas')->where('id', $id)->first();
        $horariosValidos = [];
        $horariosValidos[] = ($horarios->turnoMatutino == 1) ? "Matutino": null;
        $horariosValidos[] = ($horarios->turnoMediodia == 1) ? "Mediodia": null;
        $horariosValidos[] = ($horarios->turnoVespertino == 1) ? "Vespertino": null;
        $horariosValidos[] = ($horarios->turnoSabatino == 1) ? "Sabatino": null;
        $horariosValidos[] = ($horarios->turnoTiempoCompleto == 1) ? "TC": null;
        $horariosValidos[] = ($horarios->no_Aplica == 1) ? "No Aplica": null;
        return $horariosValidos;
    }

    //IMPRESORAS

    public function control_print()
    {
        $data = DB::table('impresoras')
            ->where('id_area', auth()->user()->area)
            ->get();

        $dataP = DB::table('ver_impresiones')
            ->select('ver_impresiones.*')
            ->join('users', 'ver_impresiones.id_Prestador', '=', 'users.id')
            ->where('sede', auth()->user()->sede)
            ->orderByDesc('ver_impresiones.fecha')
            ->get();
        $dataC = DB::table('impresion_colores')
            ->where('area_ref',  auth()->user()->area)
            ->get();

        return view('admin/modulo_impresiones',
            [ 'impresoras' =>json_encode($data),
            'impresiones' =>json_encode($dataP),
            'colores' =>json_encode($dataC),
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

        return response()->json(['message' => 'Estado cambiado exitosamente' . $id]);
    }

    public function printerstate($id, $state) {

        DB::table('impresoras')
            ->where('id', $id)
            ->update(['estado' => $state]);

        return response()->json(['message' => 'Activado exitosamente' . $id]);
    }

    public function detail_printer($id, $value) {

        $sql= DB::table('impresoras')
            ->where('id', $id)
            ->update(['observaciones' => $value]);

        return response()->json(['message' => $sql]);
    }

    public function eliminarC($id) {
        
        DB::table('impresion_colores')->where('id', $id)
            ->delete();
    
        return response()->json(['message' => 'Color eliminado']);
    }

    public function addColor (Request $request)
    {
        $request->validate([
            'color' => 'string|max:50',
        ]);

        DB::table('impresion_colores')->insert([
            'color' => $request->input('color'),
            'area_ref' =>auth()->user()->area
        ]);

        return redirect()->back()->with('success','Agregado correctamente');
    }

    public function make_print(Request $request)
    {
        $request->validate([
            'nombre' => 'string|max:255',
            'marca' => 'string|max:255',
            'tipo' => 'string|max:255',
        ]);


        DB::table('impresoras')->insert([
            'nombre' => $request->input('nombre'),
            'marca' => $request->input('mark'),
            'tipo' =>$request->input('tipo'),
            'id_area' =>auth()->user()->area
        ]);

        return redirect()->back()->with('success','Agregado correctamente');
    }

    public function create_imps()
    {
        $imps = DB::table('impresoras')
            ->where('estado', 1)
            ->get();

        $proys = DB::table('proyectos')
            ->where('id_area', auth()->user()->area)
            ->get();

        $colors = DB::table('impresion_colores')
            ->where('area_ref',  auth()->user()->area)
            ->get();

        return view('admin/registro_impresion',
        compact('imps', 'proys', 'colors'));
    }

    public function register_imps(Request $request)
    {
        $request->validate([
            'horas' => ['required_without:minutos', 'integer'],
            'minutos' => ['required_without:horas', 'integer'],
            'imp_id' => 'required|integer',
            'proyect' => 'required|integer',
            'color' => 'string | max:100',
            'weight' => 'required|regex:#^\d+(\.\d{1,2})?$#',
            'model' => 'required | string | max:100',
            'pieces' => 'required|integer',
        ]);
        
        $tiempo = $this->format_time($request->input('horas'), $request->input('minutos'));

        DB::table('seguimiento_impresiones')->insert([['id_Prestador' =>Auth::user()->id, 
        'id_Impresora' => $request->input('imp_id'), 'id_Proyecto' =>$request->input('proyect'), 
        'nombre_modelo_stl' => $request->input('model'), 'color' => $request->input('color'), 
        'piezas' => $request->input('pieces'), 'peso' => $request->input('weight'), 'tiempo_impresion' => $tiempo]]);

        $actImp = DB::table('impresoras')
            ->where('id', $request->input('imp_id'))
            ->whereNotNull('act_impresion')
            ->exists();

        if($actImp){
            $idA = DB::table('impresoras')
                ->where('id', $request->input('imp_id'))
                ->value('act_impresion');

            $TEC = DB::table('actividades')
                ->where('id', $idA)
                ->value('TEC');

            DB::table('actividades_prestadores')->insert([
                'id_prestador' => Auth::user()->id, 
                'id_actividad' => $idA,
                'estado' => "En revision",
                'Tiempo_Invertido' => $TEC,
                'id_proyecto' => $request->input('proyect')]);
        }
        
        $actual = DB::table('seguimiento_impresiones')
            ->where('id_Impresora', $request->input('imp_id'))
            ->orderByDesc('fecha')
            ->limit(1)
            ->value('fecha');

        DB::table('impresoras')
            ->where('id', $request->input('imp_id'))
            ->update(['ultimo_uso' => $actual]);

        return redirect()->route('admin.control_print');
    }

    public function format_time($hours,$minutes){

        $formatH = str_pad($hours, 2, '0', STR_PAD_LEFT);
        $formatM = str_pad($minutes, 2, '0', STR_PAD_LEFT);
        return $formatH . 'h' . $formatM . 'm';

    }

    public function module_print(){

        $actI = DB::table('actividades')
        ->where('id_categoria',6)
        ->whereNotNull('TEC')
            ->where(function($query) {
                $query->where('tipo', 0)
                      ->orWhere('tipo', Auth::user()->sede);
            })
        ->get();
        
        $actM = DB::table('actividades')
        ->where('id_categoria', 3)
        ->whereNotNull('TEC')
            ->where(function($query) {
                $query->where('tipo', 0)
                      ->orWhere('tipo', Auth::user()->sede);
            })
        ->get();

        return view( 'admin/registro_modulo_impresion', compact('actI', 'actM'));
    }

    public function set_print_act(Request $request){
        $request->validate([
            'actI' => ' integer|required',
        ]);

        DB::table('impresoras')
            ->where('id_area',  Auth::user()->area)
            ->update(['act_impresion'=> $request->input('actI')]);

        return redirect()->back()->with('success', 'Actividad asignada correctamente');
    }

    public function set_mainteneance_act(Request $request){
        $request->validate([
            'actM' => ' integer|required',
        ]);

        DB::table('impresoras')
            ->where('id_area',  Auth::user()->area)
            ->update(['act_mantenimiento'=> $request->input('actM')]);

        return redirect()->back()->with('success', 'Actividad asignada correctamente');
    }

    //CATEGORIAS Y SUBCATEGORIAS

    public function categorias(){

        $categ = DB::table('categorias')
            ->orderBy('nombre')
            ->get();

        $acts = DB::table('actividades')
            ->select('actividades.id', 'titulo', 'TEC' , 'exp_ref', 'descripcion', 'recursos', 'objetivos', 'categorias.nombre AS categoria', 'subcategorias.nombre AS subcategoria')
            ->join('categorias', 'id_categoria', '=', 'categorias.id')
            ->join('subcategorias', 'id_subcategoria', '=', 'subcategorias.id')
            ->get();

        $cat = DB::table('categorias')
            ->select('categorias.id', 'categorias.nombre',
                DB::raw('COALESCE(actividades.total_actividades, "No existen") AS total_actividades'),
                DB::raw('CASE WHEN subcategorias.total_subcategorias > 0 THEN subcategorias.total_subcategorias ELSE "No aplica" END AS total_subcategorias'))
            ->leftJoin(DB::raw('(SELECT id_categoria, COUNT(*) AS total_actividades FROM actividades GROUP BY id_categoria) as actividades'), 'categorias.id', '=', 'actividades.id_categoria')
            ->leftJoin(DB::raw('(SELECT categoria, COUNT(*) AS total_subcategorias FROM subcategorias GROUP BY categoria) as subcategorias'), 'categorias.id', '=', 'subcategorias.categoria')
            ->get();

        $subcateg = DB::table('subcategorias')
            ->select('subcategorias.*', 'categorias.nombre AS categoria')
            ->join('categorias', 'subcategorias.categoria', '=', 'categorias.id')
            ->get();
        

        return view('admin.control_actividades', ['categoria'=>$categ,  'tabla_actividades' => json_encode($acts),
        'tabla_subcategorias' => json_encode($subcateg),  'tabla_categorias' => json_encode($cat), ]);
    }

    public function filtroSubCategoria($id){
        return DB::table('subcategorias')->where('categoria', $id)->get();
        
    }

    public function nuevaCateg(Request $request){

        $request->validate([
            'nombreCateg' => 'required|max:255',
        ]);

        $buscarCat = DB::Select("Select nombre from categorias where nombre = '$request->nombreCateg'");
        if (count($buscarCat)==0){
            $nombre=$request->input("nombreCateg");
            DB::insert("INSERT INTO categorias (nombre) Values('$nombre')");
            return redirect()->back()->with('success', 'Creada correctamente');
        }else{
            return redirect()->back()->with('warning', "No se puedo crear la subcategoria");
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
            return redirect()->back()->with('success', 'Creada correctamente');
        }else{
            return redirect()->back()->with('warning', "No se puedo crear la subcategoria");
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
        $dataV = DB::table('visitas')
            ->orderBy('id', 'DESC')
            ->get();
        $dataC = DB::table('solo_clientes')
            ->get();
          
        return view('/admin/modulo_visitas', ['datosV' => json_encode($dataV), 
        'sede' => $n_sede, 'datosC' => json_encode($dataC)]);
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
        return redirect()->route('admin.ver_visitas');
    }

    //CONTROL DE SEDES

    
    public function gestHub(){
        return view('admin/gestion_hub');
    }

    public function gestionSedes(){
        $sedes = DB::table('sedes_areas');
        $s = DB::table('sedes');
        
        if(auth()->user()->tipo != 'Superadmin'){

            $sedes->where('id_sede', '=', auth()->user()->sede);
            $s->where('id_sede', '=', auth()->user()->sede);
            if(auth()->user()->tipo == 'jefe area'){
                $sedes->where('id', '=', auth()->user()->area);
            }
        }

        $sedes = $sedes->get();
        $s = $s->get();

        return view("admin.control_sedes_areas", ['s'=>$s, 'tabla_sedes' => json_encode($sedes)]);
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

    public function editA($id, $campo){
        $sql = DB::table('areas')
            ->where('id', $id)
            ->update(['nombre_area' => $campo]);
    
        if ($sql) {
            return response()->json(['message' => 'Área actualizada correctamente']);
        } else {
            return response()->json(['message' => 'Error al actualizar el área'], 500);
        }
    }

    public function editS($id, $campo){
        $sql = DB::table('sedes')
            ->where('id_sede', $id)
            ->update(['nombre_sede' => $campo]);
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
    public function  modificarSede(Request $request){
        
        $nombre=$request->input("nuevoNombre");
        $id=$request->input("idSede");

        $nombreAnterior = DB::table('sedes')->where('id_sede', $id)->value('nombre_sede');
        if(!($nombreAnterior === $nombre)){
            $request->validate([
                'nuevoNombre' => 'required|min:3|max:255|unique:sedes,nombre_Sede',
            ],
        [
            'nuevoNombre.required' => 'El campo de nuevo nombre es requerido',
            'nuevoNombre.min' => 'El nombre debe ser de mínimo 3 caracteres'
        ]);
        }
        DB::table('sedes')
        ->where('id_sede', $id)
        ->update(['nombre_sede'=>$nombre]);
        return redirect()->back()->with('success', 'Modificada correctamente');
    }

    public function modificarArea(Request $request){
        $id_sede=$request->sede_2;
        $id_area=json_decode($request->area_edit)->id;
        $nombre=$request->nuevoNombre_2;

        $nombreAnterior = DB::table('areas')->where('id', $id_area)->value('nombre_area');

        if(!($nombreAnterior === $nombre)){
            $request->validate([
                'nuevoNombre_2' => 'required|min:3|max:255|unique:sedes,nombre_Sede',
            ],
        [
            'nuevoNombre_2.required' => 'El campo de nuevo nombre es requerido',
            'nuevoNombre_2.min' => 'El nombre debe ser de mínimo 3 caracteres'
        ]);
        }
        DB::table('areas')
        ->where('id', $id_area)
        ->update(['nombre_area'=>$nombre]);
        return redirect()->back()->with('success', 'Modificada correctamente');
    }
    //CALENDARIO

    public function diasfestivos(){   

        $no_laboral = DB::table('eventos')
            ->where('sede', Auth::user()->sede)
            ->where('area', Auth::user()->area)
            ->orWhere('area', 0)
            ->orderBy('inicio')
            ->get();

        foreach($no_laboral as $valor){

            $fechaObjeto = DateTime::createFromFormat('Y-m-d H:i:s', $valor->inicio);
            $valor->inicio = $fechaObjeto->format('d-m-Y');

            $fechaObjeto = DateTime::createFromFormat('Y-m-d H:i:s', $valor->final);
            $valor->final = $fechaObjeto->format('d-m-Y');
        }

        return view('admin.modulo_fechas',['no_laboral' =>json_encode($no_laboral)]);
    }

    public function guardarfestivos(Request $request)
    {   
        $request->validate([
            'descripcion' => 'required|string|max:500',
            'tipo' => 'required | string | max:100',
            'sede' =>  'integer',
            'area' => 'integer',
        ],[
            'descripcion.required' => "El campo justificación es obligatorio",
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
            ->where(function($query) {
                $query->where('tipo', 0)
                      ->orWhere('tipo', Auth::user()->sede);
            })
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
            ->where(function($query) {
                $query->where('tipo', 0)
                      ->orWhere('tipo', Auth::user()->sede);
            })
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
            'nombre' => 'string|max:255',
            'tipo_categoria' => 'integer',
            'tipo_actividad' => 'integer',
            'recursos' => 'string', 
            'descripcion' => 'string|max:500',
            'objetivos' => 'string', 
            'exp' => 'integer|min:5|max:100',
            'horas' => [
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    $minutos = $request->input('minutos');
                    if ($value == 0 && $minutos == 0) {
                        $fail('Las horas y los minutos no pueden ser ambos 0.');
                    }
                }
            ],
            'minutos' => [
                'integer',
                function ($attribute, $value, $fail) use ($request) {
                    $horas = $request->input('horas');
                    if ($value == 0 && $horas == 0) {
                        $fail('Las horas y los minutos no pueden ser ambos 0.');
                    }
                }
            ]
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
        if ($actividad->objetivos != $request->input('objetivos')) 
            $updates['objetivos'] = $request->input('objetivos'); 
        if ($actividad->tipo != $request->input('tipo_actividad')) 
            $updates['tipo'] = $request->input('tipo_actividad');

        $updates['TEC'] = $tec;
        $updates['exp_ref'] =  $request->input('exp');

        if (!empty($updates)) {
            DB::table('actividades')->where('id', $request->input('id'))->update($updates);
        }
        return redirect('admin/actividades')->with('SUCCESS', 'Actividad agregada');
    }

    public function modificar_actividad(Request $request){
        $request->validate(
            [
                'titulo' => 'required',
                'tec' => 'required',
                'exp' => 'required',
                'categoria' => 'required',
                'subcategoria' => 'required',
                'descripcion' => 'required',
            ]
        );

        $modificar = DB::table('actividades')->where('id', $request->id_act)
        ->update(['titulo' => $request->titulo, 'tec' => $request->tec, 'exp_ref' => $request->exp, 
        'id_categoria' => $request->categoria, 'id_subcategoria' => $request->subcategoria, 'descripcion' => $request->descripcion]);

        return redirect()->route('admin.categorias')->with('success', 'Modificada correctamente');
    }

    // PREMIOS

    public function premios(){

        $premios = DB::table('premios')
            ->where('ref', auth()->user()->area)
            ->get();
        $prestadores = DB::table('solo_prestadores');
        $datos = DB::table('seguimiento_premios')
            ->select('seguimiento_premios.*')
            ->join('premios', 'seguimiento_premios.id_premio', '=', 'premios.id')
            ->where('premios.ref', auth()->user()->area)
            ->get();
        if( auth()->user()->tipo == 'jefe area'){
            $prestadores->where('id_area', auth()->user()->area);
        }else  if( auth()->user()->tipo == 'jefe sede'){
            $prestadores->where('id_sede', auth()->user()->sede);
        }
        $prestadores = $prestadores->get();
        
        return view("admin.premios", [
            'prestadores' => $prestadores,
            'premios' => $premios,
            'datos' => json_encode($datos)
        ]);
    }

    public function guardar_premio(Request $request){

        $request->validate([
            "nombre" => "required|string|max:255",
            "descripcion" => "required|string|max:255",  
            "tipo" => "required|string",
            "horas" => "integer|nullable|between:1,60", 
            "inicioVigencia" => "nullable|date", // Example date validation
            "finVigencia" => "nullable|date",     // Example date validation
            "limite" => "nullable|numeric",       // Example numeric validation
        ]);

        DB::table("premios")->insert([
            "nombre" => $request -> input("nombre"),
            "descripcion" => $request -> input("descripcion"),  
            "tipo" => $request -> input("tipo"),
            "horas" => $request -> input("horas"),
            "ref" => auth()->user()->area,
            "inicioVigencia" => $request -> input("fechaInicio"),
            "finVigencia" => $request -> input("fechaFin"),
            "Visibilidad" => $request -> input("visibilidad"),
            "limite" => $request -> input("limite"),
        ]);
       
        return redirect()->back()->with('success', 'Creada correctamente'); #cambiar redireccion
    }

    public function asignar_premio(Request $request){

        $request->validate([
            'premios' => 'required | integer',
            'prestadores_seleccionados' => 'required | array',
            'prestadores_seleccionados.*' => 'integer',
        ]);
        $prestadoresSeleccionados = $request->input('prestadores_seleccionados');
        $tamañoArreglo = count($prestadoresSeleccionados);

        for ($i = 0; $i < $tamañoArreglo; $i++) {

            $idp = $prestadoresSeleccionados[$i];
            DB::table("premios_prestadores")->insert([
                "id_premio" => $request -> input("premios"),
                "id_prestador" => $idp,  
            ]);
           
        }
        return redirect(route("admin.premios"))->with("Exito",);
    }

    public function eliminar_premio($id){
            
        DB::table("premios_prestadores")->where("id", $id)->delete();

        return response()->json(['message' => 'Premio Eliminado']);
    }

    public function verCambiarPassword(){
        return view('admin.cambioPassword');
    }

    // Cambio de contrasenia 
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

    //GAMIFICACION 

    public function gestionLvls(){

        $niveles = DB::table('niveles')
        ->where('nivel', '>', 1)
        ->orderByDesc('nivel')
        ->get();

        return view( 'admin/gestion_niveles',  ['lvls' => json_encode($niveles)]);
    }

    public function edit_XP($lvl, $value) {

        $check = DB::table('niveles')
            ->where('nivel', $lvl)
            ->value('experiencia_acumulada');

        $ultimoNivel = DB::table('niveles')
            ->orderByDesc('nivel')
            ->value('nivel');
        if($lvl != $ultimoNivel){
            if($value >= $check){
                DB::table('niveles')
                    ->where('nivel', $lvl)
                    ->update(['experiencia_acumulada' => $value+1]);
    
                DB::table('niveles')
                    ->where('nivel', $lvl+1)
                    ->update(['experiencia' => $value+2]);
            }
        }else{
            DB::table('niveles')
                ->where('nivel', $lvl)
                ->update(['experiencia_acumulada' => $value]);        
        }
        
        $sql1= DB::table('niveles')
            ->where('nivel', $lvl)
            ->update(['experiencia' => $value]);

        DB::table('niveles')
            ->where('nivel', $lvl-1)
            ->update(['experiencia_acumulada' => $value-1]);
        
        return response()->json(['message' => $sql1]);
    }

}