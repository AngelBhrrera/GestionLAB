<?php

namespace App\Http\Controllers;

use App\Models\faltas;
use Illuminate\Http\Request;

use DateTime;
use DB;
use Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class empController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sshorasP(Request $request)
    {

        $query = DB::table('horasprestadores');

        $tipo = DB::table('users')->select('id', 'name', 'apellido', 'correo', 'tipo', 'tipo_cliente', 'can_admin');

        $encargado_id = auth()->user()->encargado_id;

        if (auth()->user()->tipo === 'Superadmin') {
            // Si el usuario autenticado es Superadmin, no se aplica ninguna restricción adicional
        } else {
            // Si el usuario autenticado no es Superadmin, se aplica la restricción existente en la consulta actual
            $tipo->where('tipo', '!=', 'Superadmin');

            if ($encargado_id == null) {
                $query->where('encargado_id', auth()->user()->id);
            }
        }

        $query->get();

        return DataTables::queryBuilder($query)
            ->editColumn('estado', function ($query) {
                return view('columnTable.asistencia.radioButton')->with(["estado" => $query->estado, "id" => $query->id]);
            })
            ->editColumn('nota', function ($query) {
                return view('columnTable.asistencia.btnnota')->with(["nota" => $query->nota, "id" => $query->id, "fechaQ" => $query->fecha, "origen" => $query->origen, "fecha" => date("d/m/Y"), "hora_salida" => $query->hora_salida, "srcimagen" => $query->srcimagen]);
            })
            ->editColumn('ver', function ($query) {
                return view('columnTable.asistencia.btnver')->with(["fecha" => $query->fecha, "id" => $query->idusuario]);
            })
            ->editColumn('horas', function ($query) {
                return view('columnTable.asistencia.selecthoras')->with(["horas" => $query->horas, "id" => $query->id, "origen" => $query->origen]);
            })
            ->addColumn('act_t', function ($query) {
                $act = DB::table('actividad_terminada')->where('codigo_prestador', $query->codigo)->where('fecha', 'LIKE', '%' . $query->fecha . '%')->get();
                Log::info($query->codigo . '-' . count($act) . ' - ' . $act);
                return count($act);
            })
            ->editColumn('fecha', function ($query) {
                $date = str_replace('/', '-', $query->fecha);
                $date1 = date('d-m-Y', strtotime($date));
                $date2 = strtotime($date1);

                return [
                    'display' => $query->fecha,
                    'timestamp' => $date2
                ];
            })
            ->orderColumn('fecha', function ($query, $order) {

                $query->orderBy("id", $order);
            })


            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id, "codigo" => $query->codigo, "origen" => "horas"]);
            })
            ->rawColumns(['estado', 'nota', 'eliminar', 'ver'])
            ->make(true);
    }
    public function ssPrestadoresA()
    {
        $query = DB::table('soloprestadores')->where('horas', '>', 0);
        // $query = DB::table('soloprestadores')->where('horas_restantes', '>', 0 );
        $tipo = DB::table('users')->select('id', 'name', 'apellido', 'correo', 'tipo', 'tipo_cliente', 'can_admin');

        $encargado_id = auth()->user()->encargado_id;

        if (auth()->user()->tipo === 'Superadmin') {
            // Si el usuario autenticado es Superadmin, no se aplica ninguna restricción adicional
        } else {
            // Si el usuario autenticado no es Superadmin, se aplica la restricción existente en la consulta actual
            $tipo->where('tipo', '!=', 'Superadmin');

            if ($encargado_id == null) {
                $query->where('encargado_id', auth()->user()->id);
            }
        }

        $query->get();

        return DataTables::queryBuilder($query)
            ->addColumn('faltas', function ($query) {
                return count(DB::table('faltas')->where('id_usuario', $query->id)->get());
            })
            ->addColumn('horas_cumplidas', function ($query) {
                return view('columnTable.prestadoresA.horas_cumplidas')->with(["name" => $query->name, "id" => $query->id, 'tipo' => 'prestador', 'horas' => $query->horas_cumplidas]);
            })
            ->addColumn('acciones', function ($query) {
                return view('columnTable.prestadoresA.acciones')->with(["horario" => $query->horario, "name" => $query->name, "id" => $query->id, 'tipo' => 'prestador',]);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id, "codigo" => $query->codigo, "origen" => "usuario"]);
            })
            ->rawColumns(['acciones', 'eliminar', 'horas_cumplidas'])
            ->make(true);
    }
    public function ssPrestadoresP()
    {
        $query = DB::table('prestadorespendientes');
        $tipo = DB::table('users')->select('id', 'name', 'apellido', 'correo', 'tipo', 'tipo_cliente', 'can_admin');

        $encargado_id = auth()->user()->encargado_id;

        if (auth()->user()->tipo === 'Superadmin') {
            // Si el usuario autenticado es Superadmin, no se aplica ninguna restricción adicional
        } else {
            // Si el usuario autenticado no es Superadmin, se aplica la restricción existente en la consulta actual
            $tipo->where('tipo', '!=', 'Superadmin');

            if ($encargado_id == null) {
                $query->where('encargado_id', auth()->user()->id);
            }
        }

        $query->get();

        return DataTables::queryBuilder($query)
            ->addColumn('activacion', function ($query) {
                return view('columnTable.prestadoresP.activacion')->with(["name" => $query->name, "id" => $query->id]);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id, "codigo" => $query->codigo, "origen" => "usuario"]);
            })
            ->rawColumns(['activacion', 'eliminar'])
            ->make(true);
    }
    public function ssClientes()
    {
        $query = DB::table('soloclientes');

        return DataTables::queryBuilder($query)
            ->addColumn('horas_voluntario', function ($query) {
                $id = $query->id;
                $horas = DB::table('horasprestadores')->where('idusuario', $id)->where('estado', 'autorizado')->where('tipo', 'clientes')->sum('horas');
                return $horas;
            })
            ->addColumn('acciones', function ($query) {
                return view('columnTable.prestadoresA.acciones')->with(["name" => $query->name, "id" => $query->id, 'tipo' => 'clientes',]);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id, "codigo" => $query->correo, "origen" => "usuario"]);
            })
            ->rawColumns(['acciones', 'eliminar'])
            ->make(true);
    }
    public function ssAdministradores()
    {
        $query = DB::table('soloadmins');
        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.prestadoresA.acciones')->with(["name" => $query->name, "id" => $query->id, 'tipo' => 'admin']);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id, "codigo" => $query->correo, "origen" => "usuario"]);
            })
            ->rawColumns(['acciones', 'eliminar'])
            ->make(true);
    }

    public function ssCitas()
    {

        $query = DB::table('cita_clientes')->where('status', 'solicitud_de_impresion');
        return DataTables::queryBuilder($query)
            ->addColumn('btn', function ($query) {
                $query2 = DB::table('soloprestadores')->where('tipo', 'prestador')->get();
                $prestadoresa = $query2;

                // if($query->status == "solicitud_aceptada"){
                $verificar = DB::table('impresionesasignados')->where("id_proyecto", $query->id_citas)->select("id_prestador")->get();
                $prestadores =  $verificar;

                // }
                // else{
                //     $prestadores = null;
                // }
                return view('columnTable.citas.btncita')->with(["prestadoresa" => $prestadoresa, "id_citas" => $query->id_citas, "proyecto" => $query->proyecto, "user" => $query, "id" => $query->id,  "prestadores" => $prestadores]);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id_citas, "codigo" => $query->proyecto, "origen" => "impresion"]);
            })
            ->addColumn('link', function ($query) {
                return view('columnTable.citas.link')->with(["enlaceDrive" => $query->enlaceDrive]);
            })
            ->rawColumns(['btn', 'link', 'prestadores'])
            ->make(true);
    }

    public function ssCitas_pendientes()
    {

        $query = DB::table('cita_clientes')->where('status', 'cita_pendiente');
        return DataTables::queryBuilder($query)
            ->addColumn('btn', function ($query) {
                $query2 = DB::table('soloprestadores')->where('tipo', 'prestador')->get();
                $prestadoresa = $query2;

                if ($query) {

                    $prestadores  = DB::table('impresionesasignados')->where("id_proyecto", $query->id_citas)->select("id_prestador")->get();
                } else {
                    $prestadores = null;
                }
                return view('columnTable.citas.btn_citapendiente')->with(["prestadoresa" => $prestadoresa, "id_citas" => $query->id_citas, "proyecto" => $query->proyecto, "user" => $query, "id" => $query->id,  "prestadores" => $prestadores]);
            })
            ->addColumn('link', function ($query) {
                return view('columnTable.citas.link')->with(["enlaceDrive" => $query->enlaceDrive]);
            })
            ->rawColumns(['btn', 'link', 'prestadores'])
            ->make(true);
    }

    public function ssFirmaspendientes()
    {
        $query = DB::table('horaspendientes');
        $tipo = DB::table('users')->select('id', 'name', 'apellido', 'correo', 'tipo', 'tipo_cliente', 'can_admin');

        $encargado_id = auth()->user()->encargado_id;

        if (auth()->user()->tipo === 'Superadmin') {
            // Si el usuario autenticado es Superadmin, no se aplica ninguna restricción adicional
        } else {
            // Si el usuario autenticado no es Superadmin, se aplica la restricción existente en la consulta actual
            $tipo->where('tipo', '!=', 'Superadmin');

            if ($encargado_id == null) {
                $query->where('encargado_id', auth()->user()->id);
            }
        }

        $query->get();

        return DataTables::queryBuilder($query)
            ->editColumn('estado', function ($query) {
                return view('columnTable.asistencia.radioButton')->with(["estado" => $query->estado, "id" => $query->id]);
            })
            ->editColumn('nota', function ($query) {
                return view('columnTable.asistencia.btnnota')->with(["nota" => $query->nota, "id" => $query->id, "fechaQ" => $query->fecha, "origen" => $query->origen, "fecha" => date("d/m/Y"), "hora_salida" => $query->hora_salida, "srcimagen" => $query->srcimagen]);
            })
            ->editColumn('horas', function ($query) {
                return view('columnTable.asistencia.selecthoras')->with(["horas" => $query->horas, "id" => $query->id, "origen" => $query->origen]);
            })
            ->editColumn('ver', function ($query) {
                return view('columnTable.asistencia.btnver')->with(["fecha" => $query->fecha, "id" => $query->idusuario]);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id, "codigo" => $query->codigo, "origen" => "horas"]);
            })
            ->addColumn('act_t', function ($query) {
                $act = DB::table('actividad_terminada')->where('codigo_prestador', $query->codigo)->where('fecha', 'LIKE', '%' . $query->fecha . '%')->get();
                Log::info($query->codigo . '-' . count($act) . ' - ' . $act);
                return count($act);
            })

            ->orderColumn('fecha', function ($query, $order) {

                $query->orderBy("id", $order);
            })
            ->rawColumns(['estado', 'nota', 'eliminar', 'ver'])
            ->make(true);
    }
    public function sstablaprestadores()
    {
        $id = Auth::user()->id;
        $query = DB::table('horasprestadores')->where('idusuario', $id);
        return DataTables::queryBuilder($query)
            ->editColumn('nota', function ($query) {
                return view('columnTable.asistencia.btnnota')->with(["srcimagen" => $query->srcimagen, "nota" => $query->nota, "id" => $query->id, "fechaQ" => $query->fecha, "origen" => $query->origen, "fecha" => date("d/m/Y"), "hora_salida" => $query->hora_salida]);
            })
            ->rawColumns(['nota'])
            ->make(true);
    }
    public function sstablavisitas()
    {
        $query = DB::table('visitas');
        return DataTables::queryBuilder($query)
            ->editColumn('hora_salida', function ($query) {
                return view('columnTable.visitas.timepicker')->with(["hora_salida" => $query->hora_salida, "id" => $query->id]);
            })
            ->editColumn('motivo', function ($query) {
                return view('columnTable.visitas.btnnota')->with(["srcimagen" => null, "nota" => $query->motivo, "id" => $query->id, "fechaQ" => null, "origen" => null, "fecha" => null, "hora_salida" => true]);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id, "codigo" => $query->fecha . " " . $query->name . " " . $query->apellido, "origen" => "visitas"]);
            })
            ->rawColumns(['motivo'])
            ->make(true);
    }

    public function sstablaUserGeneral()
    {

        $query = DB::table('users')->select('id', 'name', 'apellido', 'correo', 'tipo', 'tipo_cliente', 'can_admin');

        $encargado_id = auth()->user()->encargado_id;

        if (auth()->user()->tipo === 'Superadmin') {
            // Si el usuario autenticado es Superadmin, no se aplica ninguna restricción adicional
        } else {
            // Si el usuario autenticado no es Superadmin, se aplica la restricción existente en la consulta actual
            $query->where('tipo', '!=', 'Superadmin');

            if ($encargado_id == null) {
                $query->where('encargado_id', auth()->user()->id);
            }
        }

        $query->get();

        return DataTables::queryBuilder($query)
            ->editColumn('tipo', function ($query) {
                return $query->tipo == 'prestador' && $query->can_admin == 1 ? 'Encargado de turno' : $query->tipo;
            })
            ->addColumn('acciones', function ($query) {
                return view('columnTable.prestadoresA.acciones')->with(["name" => $query->name, "id" => $query->id, 'tipo' => 'admin']);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id, "codigo" => $query->name . " " . $query->apellido, "origen" => "usuario"]);
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }


    public function ssPrestadoresProyectos()
    {
        $query = DB::table('cita_clientes')->where('status', 'impresion_marcha', 'impresion_terminar')->orwhere('status', 'impresion_terminar');
        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.citas.proyectos_prestadores_accion2')->with(["id_impresion" => $query->id_citas, "status" => $query->status]);
            })->rawColumns(['acciones'])
            ->make(true);
    }

    public function ssPrestadoresProyectosTerminados()
    {
        $query = DB::table('cita_clientes')->where('status', 'impresion_terminar');

        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.citas.proyectos_prestadores_accion')->with(["id_impresion" => $query->id_citas, "id_impresion_prestador" => $query->id_impresion_prestador]);
            })->rawColumns(['acciones'])
            ->make(true);
    }

    public function ssPrestadoresProyectosTerminados2()
    {
        $query = DB::table('cita_clientes')->where('status', 'terminado');

        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.citas.btn_documento')->with(["id_impresion" => $query->id_citas, "titulo_proyecto" => $query->proyecto, "n_piezas" => $query->N_piezas, "nombre_cliente" => $query->nombre]);
            })->rawColumns(['acciones'])
            ->make(true);
    }

    public function ssActividad()
    {
        $query = DB::table('c_actividad')->where('status', 'creado');

        $encargado_id = auth()->user()->encargado_id;
        $tipo = DB::table('users')->select('tipo');


        if (auth()->user()->tipo === 'Superadmin') {
            // Si el usuario autenticado es Superadmin, no se aplica ninguna restricción adicional
        } else {

            $tipo->where('tipo', '!=', 'Superadmin');

            if ($encargado_id == null) {
                $query->where('c_actividad.encargado_id', auth()->user()->id);
            }
        }

        $query->join('users', 'c_actividad.asignado_a', '=', 'users.id')
            ->join('actividades', 'actividades.id', '=', 'c_actividad.acti_id')
            ->join('categorias', 'categorias.id', '=', 'actividades.categoria_id')
            ->select(DB::raw("c_actividad.id_actividad, c_actividad.llave_actividad, CONCAT(users.name, ' ', users.apellido) as asignado_a, c_actividad.nombre_act, c_actividad.descripcion, c_actividad.objetivo, c_actividad.fecha, categorias.nombre AS tipo_categoria, actividades.nombre AS tipo_actividad"));

        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.actividades.acciones_actividades')->with(["id_actcreada" => $query->id_actividad, "llave_actividad" => $query->id_actividad, "actividad" => $query]);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id_actividad, "codigo" => $query->nombre_act, "origen" => "actividades"]);
            })
            ->rawColumns(['acciones', 'eliminar'])
            ->make(true);
    }


    public function ssActividadR()
    {
        $user = auth()->user()->id;
        $tipo = DB::table('users')->select('tipo')->where('id', $user)->first();
        //revision
        // en la clausula where se tiene que especificar de cual tabla se tiene que traer el encargado_id ya que aparecen en las 2 tablas (tanto actividad_completada_2 como users)

        $query = DB::table('actividad_completada_2')
            ->select('actividad_completada_2.*', DB::raw("CONCAT(users.name, ' ', users.apellido) AS nombre_prestador"))
            ->join('users', 'users.id', '=', 'actividad_completada_2.asignado_a')
            ->join('actividades', 'actividades.id', '=', 'actividad_completada_2.acti_id')
            ->join('categorias', 'categorias.id', '=', 'actividades.categoria_id')
            ->select(DB::raw("actividad_completada_2.id_actividad, actividad_completada_2.acti_id, actividad_completada_2.llave_actividad, CONCAT(users.name, ' ', users.apellido) as asignado_a, actividad_completada_2.nombre_act, actividad_completada_2.descripcion, actividad_completada_2.objetivo, actividad_completada_2.fecha, actividad_completada_2.estimacion_tiempo, actividad_completada_2.duracion, categorias.nombre AS tipo_categoria, actividades.nombre AS tipo_actividad"));
        if ($tipo->tipo === 'Superadmin') {
            // Si el usuario autenticado es Superadmin, no se aplica ninguna restricción adicional
            $query->where('actividad_completada_2.status', 'terminado');
        } else {
            $query->where('actividad_completada_2.encargado_id', auth()->user()->id)
                ->where('actividad_completada_2.status', 'terminado');
        }


        // $query->join('users', 'c_actividad.asignado_a', '=', 'users.id')
        //     ->select(DB::raw("c_actividad.id_actividad, c_actividad.llave_actividad, CONCAT(users.name, ' ', users.apellido) as asignado_a, c_actividad.nombre_act, c_actividad.descripcion, c_actividad.objetivo, c_actividad.fecha"));


        $query->get();

        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.actividades.acciones_revision')->with(["id_actcreada" => $query->id_actividad, "actividad" => $query, "nombre_act" => $query->nombre_act]);
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function ssActividadProgreso()
    {

        // $query = DB::table('c_actividad');
        $query = DB::table('c_actividad')->where('status', 'en_proceso');

        // $query = DB::table('users')->select('id','name','apellido','correo','tipo','tipo_cliente','can_admin');

        $encargado_id = auth()->user()->encargado_id;
        $tipo = DB::table('users')->select('tipo');


        if (auth()->user()->tipo === 'Superadmin') {
            // Si el usuario autenticado es Superadmin, no se aplica ninguna restricción adicional
        } else {
            // Si el usuario autenticado no es Superadmin, se aplica la restricción existente en la consulta actual
            $tipo->where('tipo', '!=', 'Superadmin');

            if ($encargado_id == null) {
                $query->where('c_actividad.encargado_id', auth()->user()->id);
            }
        }


        $query->join('users', 'c_actividad.asignado_a', '=', 'users.id')
            ->join('actividades', 'actividades.id', '=', 'c_actividad.acti_id')
            ->join('categorias', 'categorias.id', '=', 'actividades.categoria_id')
            ->select(DB::raw("c_actividad.id_actividad, c_actividad.llave_actividad, CONCAT(users.name, ' ', users.apellido) as asignado_a, c_actividad.nombre_act, c_actividad.descripcion, c_actividad.objetivo, c_actividad.fecha, c_actividad.estimacion_tiempo, categorias.nombre AS tipo_categoria, actividades.nombre AS tipo_actividad"));

        $query->get();

        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.actividades.acciones_actividades')->with(["id_actcreada" => $query->id_actividad, "llave_actividad" => $query->id_actividad, "actividad" => $query]);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id_actividad, "codigo" => $query->nombre_act, "origen" => "actividades"]);
            })
            ->rawColumns(['acciones', 'eliminar'])
            ->make(true);
    }

    public function ssActividadT()
    {
        $query = DB::table('actividad_terminada_2')
            ->where('encargado_id', auth()->user()->id);

        $user = auth()->user()->id;
        $tipo = DB::table('users')->select('tipo')->where('id', $user)->first();
        //revision
        // en la clausula where se tiene que especificar de cual tabla se tiene que traer el encargado_id ya que aparecen en las 2 tablas (tanto actividad_completada_2 como users)

        $query = DB::table('actividad_terminada_2')
            ->select('actividad_terminada_2.*', DB::raw("CONCAT(users.name, ' ', users.apellido) AS nombre_prestador"), 'actividades.nombre AS nombre_actividad', 'categorias.nombre AS nombre_categoria')
            ->join('users', 'users.id', '=', 'actividad_terminada_2.asignado_a')
            ->join('actividades', 'actividades.id', '=', 'actividad_terminada_2.acti_id')
            ->join('categorias', 'categorias.id', '=', 'actividades.categoria_id')
            ->select(DB::raw("actividad_terminada_2.id_actividad, actividad_terminada_2.acti_id, actividad_terminada_2.tipo_act, CONCAT(users.name, ' ', users.apellido) as asignado_a, actividad_terminada_2.nombre_act, actividad_terminada_2.descripcion, actividad_terminada_2.objetivo, actividad_terminada_2.fecha, actividad_terminada_2.estimacion_tiempo, actividad_terminada_2.duracion, actividad_terminada_2.experiencia_obtenida, categorias.nombre AS tipo_categoria, actividades.nombre AS tipo_actividad"));
        if ($tipo->tipo === 'Superadmin') {
            // Si el usuario autenticado es Superadmin, no se aplica ninguna restricción adicional
            // $query->where('actividad_terminada_2.status', 'terminado');Tabla de Actividades Terminadas ya revisados
        } else {
            $query->where('actividad_terminada_2.encargado_id', auth()->user()->id);
            // ->where('actividad_terminada_2.status', 'terminado');
        }

        $query->get();

        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.actividades.acciones_terninado')->with(["id_actcreada" => $query->id_actividad, "actividad" => $query, "nombre_act" => $query->nombre_act]);
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function ssActividadCanceladas()
    {
        $query = DB::table('c_actividad')->where('status', 'cancelacion_prestador');

        $encargado_id = auth()->user()->encargado_id;
        $tipo = DB::table('users')->select('tipo');


        if (auth()->user()->tipo === 'Superadmin') {
            // Si el usuario autenticado es Superadmin, no se aplica ninguna restricción adicional
        } else {
            // Si el usuario autenticado no es Superadmin, se aplica la restricción existente en la consulta actual
            $tipo->where('tipo', '!=', 'Superadmin');

            if ($encargado_id == null) {
                $query->where('c_actividad.encargado_id', auth()->user()->id);
            }
        }


        $query->join('users', 'c_actividad.asignado_a', '=', 'users.id')
            ->join('actividades', 'actividades.id', '=', 'c_actividad.acti_id')
            ->join('categorias', 'categorias.id', '=', 'actividades.categoria_id')
            ->select(DB::raw("c_actividad.id_actividad, c_actividad.llave_actividad, CONCAT(users.name, ' ', users.apellido) as asignado_a, c_actividad.nombre_act, c_actividad.descripcion, c_actividad.objetivo, c_actividad.fecha, c_actividad.estimacion_tiempo, categorias.nombre AS tipo_categoria, actividades.nombre AS tipo_actividad, c_actividad.nota_error AS nota"));

        $query->get();

        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                    return view('columnTable.actividades.acciones_canceladas')->with(["id_actcreada" => $query->id_actividad, "llave_actividad" => $query->id_actividad, "actividad" => $query]);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id_actividad, "codigo" => $query->nombre_act, "origen" => "actividades"]);
            })
            ->rawColumns(['acciones', 'eliminar'])
            ->make(true);
    }

    public function ssActividadT_personal(Request $request)
    {

        $id = $request->input('id');

        $query = DB::table('actividad_terminada')->where('id_prestador', $id);
        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.actividades.acciones_terninado')->with(["id_actcreada" => $query->llave_actividad, "actividad" => $query, "nombre_act" => $query->nombre_act]);
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function ssActividadP_personal(Request $request)
    {

        $id = $request->input('id');

        $query = DB::table('actividad_en_proceso')->where('id_prestador', $id);
        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.actividades.acciones_terninado')->with(["id_actcreada" => $query->llave_actividad, "actividad" => $query, "nombre_act" => $query->nombre_act]);
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function ssActividadR_personal(Request $request)
    {

        $id = $request->input('id');

        $query = DB::table('actividad_completada')->where('id_prestador', $id);
        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.actividades.acciones_terninado')->with(["id_actcreada" => $query->llave_actividad, "actividad" => $query, "nombre_act" => $query->nombre_act]);
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }


    public function ssProyectosCitados()
    {
        $query = DB::table('cita_clientes')->where('status', 'cita_aceptada');



        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {

                $query2 = DB::table('soloprestadores')->where('tipo', 'prestador')->get();
                $prestadoresa = $query2;
                $verificar = DB::table('impresionesasignados')->where("id_proyecto", $query->id_citas)->select("id_prestador")->get();
                $prestadores =  $verificar;

                return view('columnTable.citas.btn_asistencia')->with(["prestadoresa" => $prestadoresa, "id_citas" => $query->id_citas, "proyecto" => $query->proyecto, "user" => $query, "id" => $query->id,  "prestadores" => $prestadores]);
            })
            ->addColumn('eliminar', function ($query) {
                return view('columnTable.asistencia.btneliminar')->with(["id" => $query->id_citas, "codigo" => $query->proyecto, "origen" => "impresion"]);
            })
            ->make(true);
    }
    // --------------------------------------------------------------------------------------------------

    // ZONA DE PRESTADORES


    public function ssImpresionesTerminadas()
    {

        $query = DB::table('prestadores_impresiones')->where("id_prestador", Auth::user()->id);

        //echo "<script> alert(JSON.stringify($query)); </script>";

        return DataTables::queryBuilder($query)->make(true);
    }
    public function ssActividadTerminada()
    {

        $query = DB::table('actividad_terminada')->where("id_prestador", Auth::user()->id);
        //echo "<script> alert(JSON.stringify($query)); </script>";

        return DataTables::queryBuilder($query)->make(true);
    }
    public function ssPrestadoresI()
    {
        $query = DB::table('prestadoresinactivos');
        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.prestadoresI.acciones')->with(["name" => $query->name, "id" => $query->id, 'tipo' => 'prestador',]);
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function ssPrestadoresL()
    {
        $query = DB::table('prestadores_liberados_servicio');
        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.prestadoresI.acciones')->with(["name" => $query->name, "id" => $query->id, 'tipo' => 'prestador',]);
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function ssPrestadoresT()
    {
        $query = DB::table('prestadoresterminados');
        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.prestadoresT.acciones')->with(["name" => $query->name, "id" => $query->id, 'tipo' => 'prestador',]);
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function ssFaltas()
    {
        $query = DB::table('faltas');
        return DataTables::queryBuilder($query)
            ->make(true);
    }

    public function ssDiasFestivos()
    {
        $query = DB::table('dias_festivos');
        return DataTables::queryBuilder($query)
            ->addColumn('acciones', function ($query) {
                return view('columnTable.diasfestivos.btneliminar')->with(["id" => $query->id, "fecha" => $query->fecha]);
            })
            ->make(true);
    }

    public function sshorario()
    {
        $query = DB::table('horarios');
        return DataTables::queryBuilder($query)
            ->addColumn('diasHorario', function ($query) {
                return view('columnTable.horarios.diasvista')->with([
                    "id" => $query->Id, "lunes" => $query->lunes,
                    "martes" => $query->martes,
                    "miercoles" => $query->miercoles,
                    "jueves" => $query->jueves,
                    "viernes" => $query->viernes,
                    "sabado" => $query->sabado,
                    "domingo" => $query->domingo, "origen" => "horariosEspeciales"
                ]);
            })
            ->addColumn('acciones', function ($query) {
                return view('columnTable.horarios.btneliminar')->with(["id" => $query->Id, "descripcion" => $query->descripcion, "origen" => "horariosEspeciales"]);
            })
            ->make(true);
    }
}
