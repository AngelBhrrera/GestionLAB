<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//Estimado prestador de servicio que tiene que dar mantenimiento a esta fregadera [Abril, 2023]

        //mire compa, al chile cuando empezamos esto no sabiamos un carajo, tuvimos que improvisar jeje
        // suerte
        //att. los de sistemas
        //pd. si cree que es mas facil volver a hacerlo desde 0, pues hagalo y no este chingando
        //pd2. pura clika 14 alv
        //pd3. Uwu

//Estimado prestador de servicio al que le toco continuar con este proyecto... [Febrero, 2024]
        //Asi como los de sistemas, nosotros tambien empezamos sin saber nada de Laravel, Migraciones, AJAX y Tailwind
        //Sin embargo tratamos de darle un mejor orden. No es perfecto, pero es trabajo honesto
        //Como dijo un gran ingeniero:
        //    "Always leave a place better than you found it."
        //                                          ―Iron Man
        //PD.
        

//Rutas generales
Auth::routes([
    'verify' => false,
]);

Route::get('/spiderw', function(){
    return view('/TEST/spider');
})->name('spider');

Route::group(['middleware'=>'auth'], function (){
    Route::controller(App\Http\Controllers\PrestadorController::class)->group(function(){
        Route::get('/descargar/{nombreArchivo}', 'descargar_reporte')->name('descargar_reporte');
        Route::get('/visualizar_reporte/{nombreArchivo}', 'visualizar_reporte')->name('visualizar');
    });
    Route::get('/obtenerImagen/{nombreArchivo}', function($nombreArchivo){
        if($nombreArchivo != "false"){
            $rutaImagen = storage_path('app/public/userImg/' . $nombreArchivo);
            if (!file_exists($rutaImagen)) {
                $rutaImagen = storage_path('app/public/userImg/default-profile-image.png');
            }
        }else{
            $rutaImagen = storage_path('app/public/userImg/default-profile-image.png');
        }
        
        readfile($rutaImagen);
    })->name('obtenerImagen');
    
});

Route::controller(App\Http\Controllers\LandingController::class)->group(function(){
    Route::get('/inventores', 'index')->name('landing');
    Route::get('/devTeam', 'devTeam')->name('devTeam');
    Route::get('/articulos', 'articulos')->name('articulos');
});

Route::controller(App\Http\Controllers\HomeController::class)->group(function(){
    //Route::post('/crearImpresion', 'crearImpresion')->middleware('guest')->name('crearImpresion'); <--- registro de las solicitudes de impresion 3D
    Route::name('inventores.')->group(function (){
        Route::post('update', 'update')->name('update');
        Route::get('modificaradmin', 'modificaradmin')->name('modificaradmin');
        Route::get('/inventores/form', 'formp')->name('formp');  // ruta del formulario publico
        Route::post('/inventores/form', 'public_form')->name('formulariop'); // nueva ruta para el formulario publico
    });
});

Route::controller(App\Http\Controllers\Auth\RegisterController::class)->group(function(){
    Route::post('/registro', 'register')->name('registrar');
});

Route::controller(App\Http\Controllers\Auth\logsysController::class)->group(function(){

    Route::get('/', 'redirectTo')->name('root');
    Route::get('/register', 'show')->name('register')->middleware('guest');
    Route::get('/login', 'log')->name('login')->middleware('guest');
    Route::post('/login', 'loginF')->name('login');
    Route::get('/logout', 'logoutF')->name('logout');

    Route::name('api.')->group(function () {
        //FILTRADOS DEL REGISTER GUEST
        Route::get('/sede/{id}', 'filtroSede')->name('filtroSede');
        Route::get('/area/{id}', 'filtroArea')->name('filtroArea');
        Route::get('/turno/{t}/{sed}', 'filtroTurno')->name('filtroTurno');
        //FILTRADOS DEL REGISTER ADMIN
        Route::get('admin/sede/{id}', 'filtroSede')->name('filtroSede');
        Route::get('admin/area/{id}', 'filtroArea')->name('filtroArea');
        Route::get('admin/turno/{t}/{sed}', 'filtroTurno')->name('filtroTurno');
    });
});

Route::controller(App\Http\Controllers\AdminController::class)->group(function(){

    Route::middleware('role:Superadmin,jefe sede,jefe area,coordinador')->group(function() {
        
        Route::name('admin.')->group(function () {

            Route::middleware('role:jefe area,jefe sede,Superadmin,coordinador')->group(function() {

                Route::middleware('role:coordinador')->group(function() {
                    Route::get('admin/cambiarRol', 'cambiarRol')->name('cambiorol');
                });

                
                Route::get('/admin/registro', 'registro')->name('registro'); //NUEVA RUTA

                Route::get('/admin/premios', 'premios')->name('premios');
                Route::get('/admin/premios_tabulador', 'gestor_premios')->name('gestor_premios');
                Route::get('admin/eliminar_premio/{value}', 'eliminar_premio')->name('eliminar_premio');

                Route::get('admin/ver_reportes_parciales', 'ver_reportes_parciales')->name('reportes_parciales');
                Route::get('admin/ver_reportes_parciales/busqueda', 'busqueda_reportes_parciales')->name('busqueda_reportes_parciales');

                Route::get('/admin/administradores', 'administradores')->name('administradores');
                Route::get('/admin/admin_prestadores_terminados','admin_prestadores_terminados')->name('admin_prestadores_terminados');

                Route::get('admin/gestionSede', 'gestionSedes')->name('sede');

                Route::post('admin/nuevaSede', 'nuevaSede')->name('nuevaSede');
                Route::post('admin/nuevaArea', 'nuevaArea')->name('nuevaArea');
                Route::post('admin/modificarSede', 'modificarSede')->name('modificarSede');
                    
                Route::get('/admin/faltas', 'faltas')->name('faltas');
                Route::get('/admin/horarios', 'horarios')->name('horarios');
                Route::get('/admin/Dias_no_laborables', 'diasfestivos')->name('diasfestivos');
                Route::post('/admin/agregar_festivos', 'guardarFestivos')->name('agregar_festivos');
                Route::get('admin/eliminarFestivo/{id}', 'eliminardiafestivo')->name('eliminarFestivo');
                Route::post('admin/editarFestivo', 'editardiafestivo')->name('editarFestivo');

                Route::get('/admin/categorias', 'categorias')->name('categorias');
                Route::post('/admin/n_categoria', 'nuevaCateg')->name('nuevaCateg');
                Route::post('/admin/n_subcategoria', 'nuevaSubcateg')->name('nuevaSubcateg');

                Route::middleware('role:Superadmin')->group(function() {
                    Route::get('/superadmin/gestion', 'gestionViews')->name('gestionViews');
                });
                    
            });


            Route::get('/admin/home', 'firmas')->name('home');
            Route::get('/admin/firmas', 'firmas')->name('firmas');
            Route::get('admin/check-in', 'checkin')->name('checkin');
            //FILTROS PARA ACTIVIDADES
            Route::get('/admin/obtenerActividades', 'obtenerActividades')->name('obtenerActividades');
            Route::get('/admin/obtenerActividadesB', 'obtenerActividadesB')->name('obtenerActividadesB');
            Route::get('/admin/obtenerSubcategoria', 'obtenerSubcategoria')->name('obtenerSubcategorias');
            Route::get('/admin/obtenerPrestadores', 'obtenerPrestadores')->name('obtenerPrestadoresProyecto');
            //RUTAS ACTIVIDADES Y ASIGNACIONES
            Route::get('/admin/C_actividades', 'create_act')->name('create_act');
            Route::post('/admin/M_actividades', 'make_act')->name('make_act');
            Route::get('/admin/A_actividades', 'asign_act')->name('asign_act');

            Route::get('admin/ver_detalles_proyecto/detalles_actividad/{val}','detallesActividad')->name('detallesActividad');

            Route::get('/admin/ver_actividades', 'actividades')->name('actividades');
            Route::get('/admin/actividades_en_progreso','actividades_en_progreso')->name('actividades_en_progreso');
            Route::get('/admin/actividades_revision', 'actividades_revision')->name('actividades_revision');
            //RUTAS PROYECTOS Y ASIGNACIONES
            Route::get('/admin/C_proyectos', 'create_proy')->name('create_proy');
            Route::post('/admin/M_proyecto', 'make_proy')->name('make_proy');
            Route::post('/admin/asign', 'asign')->name('asign');
            Route::post('/admin/asign2', 'asign2')->name('asign2');
            Route::get('/admin/ver_proyectos', 'view_proys')->name('view_proys');
            Route::get('/admin/ver_detalles_proyecto/{id}', 'view_details_proy')->name('view_details_proy');
            Route::get('/admin/ver_detalles_proyecto/ver_detalles_actividad/{id}', 'view_details_act')->name('view_details_act');
            //MODULO IMPRESIONES
            Route::get('/admin/ver_impresoras', 'control_print')->name('control_print');
            Route::post('/admin/registrar_impresoras', 'make_print')->name('make_print');
            Route::get('/admin/ver_impresiones', 'watch_prints')->name('watch_prints');
            //MODULO DE PRESTADORES
            Route::get('/admin/general', 'general')->name('general');
            Route::get('/admin/prestadores', 'prestadores')->name('prestadores');
            Route::get('/admin/prestadores_pendientes', 'prestadores_pendientes')->name('prestadores_pendientes');
            Route::get('/admin/prestadores_inactivos', 'prestadores_inactivos')->name('prestadores_inactivos');
            Route::get('/admin/prestadores_liberados', 'prestadores_liberados')->name('prestadores_liberados');
            Route::get('/admin/prestadores_terminados','prestadores_terminados')->name('prestadores_terminados');
            //MODULO VISITAS
            Route::get('/admin/clientes', 'clientes')->name('clientes');
            Route::get('/admin/visitas', 'visits')->name('visitas');
            Route::get('/admin/ver_visitas', 'watch_visits')->name('visitas_reg');
            Route::get('admin/motivo_visita/{id}/{value}', 'motivo')->name('motivo');
            Route::get('/admin/registrovisitas', 'registroVisitas')->name('registrovisitas');

            Route::middleware('role:coordinador')->group(function() {
                Route::get('admin/cambiarRol', 'cambiarRol')->name('cambiorol');
            });

            Route::middleware('role:jefe area,jefe sede,Superadmin')->group(function() {

                Route::middleware('role:Superadmin')->group(function() {
                    Route::get('/superadmin/gestion', 'gestionViews')->name('gestionViews');
                });
                
                Route::get('/admin/registro', 'registro')->name('registro'); 

                Route::get('/admin/administradores', 'administradores')->name('administradores');
                //MODULO PREMIOS
                Route::get('/admin/premios', 'premios')->name('premios');
                Route::post('admin/g_premio', 'guardar_premio')->name('guardar_premio');
                Route::post("admin/a_premio", "asignar_premio")->name("asignar_premio");
                Route::get('/admin/verpremios', 'gestor_premios')->name('gestor_premios');
                //MODULO REPORTES
                Route::get('admin/ver_reportes_parciales', 'ver_reportes_parciales')->name('reportes_parciales');
                Route::get('admin/ver_reportes_parciales/busqueda', 'busqueda_reportes_parciales')->name('busqueda_reportes_parciales');
                //MODULO SEDES
                Route::get('admin/gestionSede', 'gestionSedes')->name('sede');
                Route::post('admin/nuevaSede', 'nuevaSede')->name('nuevaSede');
                Route::post('admin/nuevaArea', 'nuevaArea')->name('nuevaArea');
                Route::post('admin/modificarSede', 'modificarSede')->name('modificarSede');
                //MODULO CALENDARIO
                Route::get('/admin/faltas', 'faltas')->name('faltas');
                Route::get('/admin/horarios', 'horarios')->name('horarios');
                Route::get('/admin/Dias_no_laborables', 'diasfestivos')->name('diasfestivos');
                Route::post('/admin/agregar_festivos', 'guardarFestivos')->name('agregar_festivos');
                //MODULO CATEGORIAS
                Route::get('/admin/categorias', 'categorias')->name('categorias');
                Route::post('/admin/n_categoria', 'nuevaCateg')->name('nuevaCateg');
                Route::post('/admin/n_subcategoria', 'nuevaSubcateg')->name('nuevaSubcateg'); 
            });

        });

        Route::name('api.')->group(function () {
            Route::post('/actualizar', 'guardar')->name('actualizar');
            Route::post('/actualizarb', 'guardar2')->name('actualizarb');
            //AJUSTES DE PRESTADOR
            Route::get('admin/modificar_horario_prestador/{id}/{value}', 'cambiar_horario')->name('cambiar_horario');
            Route::get('admin/modificar_tipo_prestador/{id}/{value}', 'cambiar_tipo')->name('cambiar_tipo');
            Route::get('admin/activar_prestador/{value}', 'activar')->name('activar');
            Route::get('admin/desactivar_prestador/{value}', 'desactivar')->name('desactivar');
            //AJUSTES DE IMPRESION
            Route::get('admin/activar_impresora/{value}', 'activate_print')->name('activate_print');
            Route::get('admin/changestate_print/{id}/{value}', 'printstate')->name('printstate');
            Route::get('admin/observaciones_impresion/{id}/{value}', 'detail_prints')->name('detail_prints');
            
            Route::middleware('role:jefe area,jefe sede,Superadmin')->group(function() {
                //API PRESTADOR
                Route::get('admin/liberar_prestador/{value}', 'liberar')->name('liberar');
                Route::get('admin/eliminar_prestador/{value}', 'eliminar')->name('eliminar');
                //API CHECKIN
                Route::get('admin/changestate/{id}/{value}', 'checkinstate')->name('checkinstate');
                //API SEDES
                Route::get('admin/activar_area/{id}/{campo}', 'activate_area')->name('activatearea');
               
            });
            /*
            Route::post('/actualizarcursos1',  'guardarcursos1')->name('actualizarcursos1');
            Route::post('/actualizarcursos2', 'guardarcursos2')->name('actualizarcursos2');
            Route::post('/actualizarcursos3',  'guardarcursos3')->name('actualizarcursos3');
            Route::post('/actualizarstatus','guardarstatus')->name('actualizarstatus');
            Route::post('/eliminar', 'destroy')->name('eliminar');
            Route::post('/activar',  'activar')->name('activar');
            Route::post('/cita_programar', 'cita_programar')->name('cita_programar');
            Route::post('/cita_programar_2',  'cita_programar_2')->name('cita_programar_2');
            Route::post('/cita_programar_3',  'cita_programar_3')->name('cita_programar_3');
            Route::post('/create_premios', 'create_premios')->name('create_premios');
            Route::get('/check-in','checkin')->name('checkin')->middleware('role:checkin');
            Route::post('/prestadores_asignados','prestadores_asignados')->name('prestadores_asignados');
            Route::post('/impresion_terminada',  'impresion_terminada')->name('impresion_terminada');
            Route::post('/documento','documento')->name('documento');
            Route::post('/actividad_asignada', 'actividad_asignada')->name('actividad_asignada');
            Route::post('/actividad_reasignada', 'actividad_reasignada')->name('actividad_reasignada');
            Route::post('/agregar_categoria_y_actividad','agregarCategoriaActividad')->name('agregarCategoriaActividad');
            Route::post('/denegar_impresion',  'denegar_impresion')->name('denegar_impresion');
            Route::post('/impresion_marcha', 'impresion_marcha')->name('impresion_marcha');
            Route::post('/eliminar_prestadores_impresion', 'eliminar_prestadores_impresion')->name('eliminar_prestadores_impresion');
            */

        });
                /*
                Route::get('/admin/modificar', 'modificar')->name('modificar');
                Route::get('/admin/citas', 'citas')->name('citas');
                Route::get('/admin/citas_pendientes', 'citas_pendientes')->name('citas_pendientes');
                Route::post('/admin/descargarArchivo', 'descargarArchivo')->name('descargarArchivo');
                Route::post('/admin/verImagenCredencial')->name('verCredencial');
                Route::post('/admin/verImagenRender', 'verRender')->name('verRender');
                Route::get('/admin/firmasPendientes', 'firmasPendientes')->name('firmasPendientes');
                Route::get('/admin/recompensasRegistro', 'recompensas')->name('recompensas');
                Route::post('/admin/update',  'App\Http\Controllers\AdminController@adminUpdate')->name('update');
                Route::get('/admin/prestadoresProyectos', 'prestadoresProyectos')->name('prestadoresProyectos');
                Route::get('/admin/prestadoresProyectos2', 'prestadoresProyectos2')->name('prestadoresProyectos2');
                Route::get('/admin/prestadoresProyectos3', 'prestadoresProyectos3')->name('prestadoresProyectos3');
                Route::get('/admin/ProyectosCitados', 'ProyectosCitados')->name('ProyectosCitados');
                Route::get('/admin/actividades_revision/{id}/detalles', 'actividadDetalles')->name('actividades.detalles');
                Route::get('/admin/actividades_revision/finalizar/{id}/{experiencia}', 'actividadRevisada')->name('actividadRevisada');
                Route::post('/admin/terminar_actividad', 'terminar_actividad')->name('terminar_actividad');
                Route::post('/admin/actividad_cancelar', 'actividad_cancelar')->name('actividad_cancelar');
                Route::get('/admin/tabla_terminados', 'tabla_terminados')->name('tabla_terminados');
                Route::get('/admin/tabla_actividades_canceladas', 'tabla_actividades_canceladas')->name('tabla_actividades_canceladas');
                Route::post('/admin/mod', 'actividad_modificar')->name('actividad_modificar');
                Route::post('/admin/reasignar','actividad_cancelada')->name('actividad_cancelada');
                Route::post('/admin/participantes', 'participantes')->name('participantes');
                Route::get('/admin/horario', 'horarioadmin')->name('horarioadmin');
                Route::post('prestador/horario_guardar_admin', 'horario_guardar_admin')->middleware('role:prestador,admin,Superadmin')->name('horario_guardar_admin');
                Route::get('/admin/veractividades', 'veractividades')->name('veractividades');
                Route::get('/admin/veractividades_pendientes', 'veractividades_pendientes')->name('veractividades_pendientes');
                Route::get('/admin/veractividades_completadas', 'veractividades_completadas')->name('veractividades_completadas');
                Route::get('/admin/actividades_revision/{id}/detalles', 'actividadDetalles')->name('actividad.detalles');
                Route::get('/admin/actividades_revision/{id}', 'finalizarActividad')->name('finalizar.actividad');
                Route::get('/actividad-revisada/{id}/{experiencia}', 'vistaFinalizacionActividad')->name('admin.actividadRevisada');
                */
    });

});

//Rutas Prestador
Route::controller(App\Http\Controllers\PrestadorController::class)->group(function(){
    Route::name('api.')->group(function () {
        Route::post('/marcar', 'marcar')->middleware('role:coordinador,jefe area,jefe sede,Superadmin,checkin')->name('marcar'); 
    });
    
    Route::middleware('role:prestador,voluntario,practicante,coordinador')->group(function() {
        Route::middleware('role:coordinador')->group(function() {
            Route::get('prestador/cambiarRol', 'cambiarRol')->name('cambiarRol');
        });

        Route::get('prestador/home', 'home')->name('homeP');
        //MODULO PERFIL
        Route::get('/prestador/home/perfil', 'perfil')->name('perfil');
        Route::post('/prestador/home/perfil/cambiar-imagen-perfil', 'cambiarImagenPerfil')->name('cambiarImagenPerfil');
        //MODULO REPORTES
        Route::get('prestador/reportes_parciales', 'show_reportes')->name('parciales');
        Route::post('prestador/subir_reporte_parcial', 'subir_reportes_parciales')->name('subirReporte');
        Route::get('prestador/eliminar_reporte_parcial/{id}', 'eliminar_reportes_parciales')->name('eliminarReporte');
        //MODULO IMPRESIONES
        Route::get('prestador/registro_impresion', 'create_imps')->name('create_imps');
        Route::post('prestador/registrar_impresion', 'register_imps')->name('register_imps');
        Route::get('prestador/mostrar_mis_impresiones', 'show_imps')->name('show_imps');
        Route::get('prestador/mostrar_impresiones', 'show_all_imps')->name('show_all_imps');
        Route::get('prestador/changestate_print/{id}/{value}', 'printstate')->name('printstate');
        Route::get('prestador/observaciones_impresion/{id}/{value}', 'detail_prints')->name('detail_prints');
        //MODULO HORARIO
        Route::get('prestador/horas', 'horas')->name('horas');
        Route::get('prestador/horario', 'horario')->name('horario');
        Route::get('/prestador/asistencias', 'asistencias')->name('asistencias');
        //FILTROS RUTAS ACTIVIDADES
        Route::get('prestador/obtenerActividades', 'obtenerActividades')->name('obtenerActividades');
        Route::get('prestador/obtenerActividadesB', 'obtenerActividadesB')->name('obtenerActividadesB');
        Route::get('prestador/obtenerSubcategoria', 'obtenerSubcategorias')->name('obtenerSubcategorias');

        Route::get('prestador/actividadesAsignadas', 'actividadesAsignadas')->name('actividadesAsignadas');
        Route::get('prestador/actividadesAbiertas', 'actPull')->name('actPull');
        Route::get('prestador/tomarActividad/{id}/{teu}', 'takeAct')->name('takeAct');
        Route::get('prestador/comenzarActividad/{id}/{teu}', 'startAct')->name('startAct');
        Route::get('prestador/actividadStatus/{id}/{mode}', 'statusAct')->name('statusAct');
        //RUTAS ACTIVIDADES
        Route::get('prestador/C_actividades', 'create_act')->name('create_act');
        Route::post('prestador/M_actividades', 'make_act')->name('make_act');
        Route::get('prestador/A_actividades', 'asign_act')->name('asign_act');
        Route::get('prestador/misActividades','misActividades')->name('misActividades');

        Route::get('prestador/miProyecto','myProject')->name('myProject');
        Route::get('prestador/detalles_actividad/{val}','detallesActividad')->name('detallesActividad');
        Route::get('prestador/observaciones_actividad/{id}/{val}', 'detail_act')->middleware('role:prestador,practicante,voluntario,coordinador,jefe area,jefe sede')->name('detail_act');
        //MODULO GAMIFICACION
        Route::get('prestador/nivel', 'level_progress')->name('level');


        Route::post('prestador/completar_impresion','completar_impresion')->name('completar_impresion');
        Route::post('prestador/completar_actividad', 'completar_actividad')->name('completar_actividad');
        Route::get('prestador/completar_impresion_tabla', 'prestadoresProyectosCompletados')->name('prestadoresProyectosCompletados');
        Route::get('prestador/completar_actividad_tabla', 'Pactividadterminada')->name('Pactividadterminada');
        Route::get('prestador/obtenerActividades', 'obtenerActividades')->name('obtenerActividades');
        Route::get('prestador/actividades_prestadores', 'actividades_prestadores')->name('actividades_prestadores');
        Route::post('prestador/registro_reporte_guardar', 'registro_reporte_guardar')->name('registro_reporte_guardar');
        Route::put('prestador/actividades_prestadores/{id}', 'contarTiempoActividad')->name('contarTiempoActividad');
        Route::put('prestador/actividades_prestadores/{id_actividad}', 'finalizarActividad')->name('finalizarActividad');
        Route::get('prestador/actividades_creadas', 'actividades_creadas')->name('actividades_creadas');
        Route::put('prestador/actividades_creadas/{id}', 'enProcesoActividad')->name('enProcesoActividad');
        Route::get('prestador/actividades_en_proceso', 'actividades_en_proceso')->name('actividades_en_proceso');
        Route::get('prestador/actividades_terminadas', 'actividadesTerminadas')->name('actividadesTerminadas');
        Route::put('prestador/actividades_terminadas/{id_actividad}', 'terminarActividad')->name('terminarActividad');
        Route::get('prestador/actividades_prestadores_revisadas', 'actividades_prestadores_revisadas')->name('actividades_prestadores_revisadas');
        Route::get('prestador/actividades_canceladas', 'actividades_canceladas')->name('actividades_canceladas');
        Route::put('prestador/actividades_creadas/{id_actividad}',  'retomarActividad')->name('retomarActividad');
        Route::get('/prestador/faltas', 'faltas')->name('faltas');
        Route::post('prestador/cancelacion_prestador', 'cancelacion_prestador')->name('cancelacion_prestador');

        // Route::get('/proyectospendientes', 'proyectos')->name('proyectos');
        // Route::get('/proyectos_prendientes', 'proyectos_prendientes')->name('proyectos_prendientes');
    });

});

Route::controller(App\Http\Controllers\VisitanteController::class)->group(function(){
    Route::name('cliente.')->group(function () {
        Route::get('/registro','registro')->name('registro');
        Route::middleware('role:alumno,maestro,externo')->group(function() {

            Route::get('/cliente/home','principal')->name('home');
            Route::post('/cliente/confirmar_cita','confirmar_cita')->name('confirmar_cita');
            Route::post('/cliente/cita','guardarCita')->name('cita');
            Route::post('/cliente/visitaguardar','guardarVisita')->name('guardarVisita');
            Route::get('/cliente/visitas', 'principal')->name('visitas');
            Route::get('/cliente/reg', 'form')->name('form');
            Route::post('/cliente/reg', 'registro_impresion_form')->name('formulariof'); // ruta formulario no publica
        });    
    });
});

Route::controller(App\Http\Controllers\MailController::class)->group(function(){
    Route::name('email.')->group(function () {
        Route::middleware('guest')->group(function() {
            Route::get('visitante/correo', 'sendEmail')->name('impresion');
        });
    });
});


Route::match(['get', 'post'], '/botman', [App\Http\Controllers\BotManController::class, 'handle']);

Route::get('/bot', function () {
    return view('boot');
});

