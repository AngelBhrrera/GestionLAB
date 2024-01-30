<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Estimado prestador de servicio que tiene que dar mantenimiento a esta fregadera

        //mire compa, al chile cuando empezamos esto no sabiamos un carajo, tuvimos que improvisar jeje
        // suerte
        //att. los de sistemas
        //pd. si cree que es mas facil volver a hacerlo desde 0, pues hagalo y no este chingando
        //pd2. pura clika 14 alv
        //pd3. Uwu

//Rutas generales
Auth::routes([
    'verify' => false,
]);

Route::get('/foo', function () {
    Artisan::call('storage:link');
    });

//PRUEBAS
Route::get('/adminLayout', function(){
    return view('admin.PruebaAdminLayout');
});

Route::get('/spiderw', function(){
    return view('/TEST/spider');
})->name('spider');

Route::get('/calendar', function(){
    return view('/TEST/calendar');
})->name('calendar');

Route::controller(App\Http\Controllers\LandingController::class)->group(function(){
    Route::get('/inventores', 'index')->name('landing');
    Route::get('/devTeam', 'devTeam')->name('devTeam');
    Route::get('/articulos', 'articulos')->name('articulos');
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
});

//Rutas de Admin gestionadas desde el AdminController
//Requieres el rol admin o superadmin para acceder 
//Por el momento no encuentro diferencias entre admin y superadmin palpables
Route::controller(App\Http\Controllers\AdminController::class)->group(function(){
    Route::name('api.')->group(function () {

        Route::middleware('role:admin,Superadmin')->group(function() {
            Route::post('/actualizar', 'guardar')->name('actualizar');
            Route::post('/actualizarb', 'guardar2')->name('actualizarb');
        });

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
        Route::post('/desactivar_prestadores','desactivar_prestadores')->name('desactivar_prestadores');
        Route::post('/activar_prestadores', 'activar_prestadores')->name('activar_prestadores');
        Route::post('/denegar_impresion',  'denegar_impresion')->name('denegar_impresion');
        Route::post('/impresion_marcha', 'impresion_marcha')->name('impresion_marcha');
        Route::post('/eliminar_prestadores_impresion', 'eliminar_prestadores_impresion')->name('eliminar_prestadores_impresion');
        Route::post('/proyectos_prestador_terminados','proyectos_prestador_terminados')->name('proyectos_prestador_terminados');
        Route::post('/terminar_prestadores','terminar_prestadores')->name('terminar_prestadores');
        Route::post('/admin/guardardias',  'guardardiafestivo')->name('guardardiasfestivos');
        Route::post('/admin/eliminardias', 'eliminardiafestivo')->name('eliminardiafestivo');
        Route::post('/admin/eliminarhorario','eliminarhorario')->name('eliminarhorario');
        Route::post('/admin/guardarhorario',  'guardarhorario')->name('guardarhorario');
    });

        Route::name('admin.')->group(function () {

            Route::middleware('role:admin,Superadmin,encargado')->group(function() {

                Route::get('/admin/home', 'firmas')->name('home');

                Route::get('/admin/cambiarRol', 'cambiarRol')->name('cambiorol');
                Route::get('/admin/check-in', 'checkin')->name('checkin');

                Route::get('/admin/C_actividades', 'create_act')->name('create_act');
                Route::post('/admin/M_actividades', 'make_act')->name('make_act');
                Route::get('/admin/A_actividades', 'asign_act')->name('asign_act');
                Route::get('/admin/actividades', 'actividades')->name('actividades');

                Route::get('/admin/C_proyectos', 'create_proy')->name('create_proy');

                Route::get('/admin/ver_impresoras', 'control_print')->name('control_print');
                Route::post('/admin/registrar_impresoras', 'make_print')->name('make_print');
                Route::get('/admin/ver_impresiones', 'watch_prints')->name('watch_prints');
                Route::get('admin/activar_impresora/{value}', 'activate_print')->name('activate_print');

                Route::get('/admin/general', 'general')->name('general');
                Route::get('/admin/prestadores', 'prestadores')->name('prestadores');
                Route::get('admin/modificar_horario_prestador/{id}/{value}', 'cambiar_horario')->name('cambiar_horario');
                Route::get('admin/activar_prestador/{value}', 'activar')->name('activar');
                Route::get('admin/eliminar_prestador/{value}', 'eliminar')->name('eliminar');
                Route::get('admin/desactivar_prestador/{value}', 'desactivar')->name('desactivar');
                
                Route::get('/admin/clientes', 'clientes')->name('clientes');

                Route::get('/admin/visitas', 'visits')->name('visitas');
                Route::get('/admin/ver_visitas', 'watch_visits')->name('visitas_reg');

                Route::get('/admin/faltas', 'faltas')->name('faltas');
                Route::get('/admin/horarios', 'horarios')->name('horarios');
                
                Route::get('/admin/obtenerActividades', 'obtenerActividades')->name('obtenerActividades');
                Route::get('/admin/newCategoriaYActividad', 'newCategoriaYActividad')->name('newCategoriaYActividad');


                Route::middleware('role:admin,Superadmin')->group(function() {

                    Route::get('/admin/registro', 'registro')->name('registro'); //NUEVA RUTA
                    Route::get('admin/gestionSedes', 'gestionSedes')->name('sedes');
                    Route::post('admin/nuevaSede', 'nuevaSede')->name('nuevaSede');
                    Route::post('admin/modificarSede', 'modificarSede')->name('modificarSede');
                    Route::get('admin/changestate/{id}/{value}', 'checkinstate')->name('checkinstate');
                    Route::get('/admin/premios', 'premios')->name('premios');

                    Route::get('/admin/dias_festivos', 'diasfestivos')->name('diasfestivos');
                    Route::post('/admin/agregar_festivos', 'guardarFestivos')->name('agregar_festivos');

                    Route::get('admin/liberar_prestador/{value}', 'liberar')->name('liberar');
                    Route::get('/admin/administradores', 'administradores')->name('administradores');
                    Route::get('admin/ver_reportes_parciales', 'ver_reportes_parciales')->name('reportes_parciales');
                    Route::get('admin/ver_reportes_parciales/busqueda', 'busqueda_reportes_parciales')->name('busqueda_reportes_parciales');
                });

               
                Route::get('/admin/modificar', 'modificar')->name('modificar');
               
                Route::get('/admin/citas', 'citas')->name('citas');
                Route::get('/admin/citas_pendientes', 'citas_pendientes')->name('citas_pendientes');
                Route::get('/admin/prestadoresPendientes', 'prestadoresPendientes')->name('prestadoresPendientes');
                Route::post('/admin/descargarArchivo', 'descargarArchivo')->name('descargarArchivo');
                Route::post('/admin/verImagenCredencial')->name('verCredencial');
                Route::post('/admin/verImagenRender', 'verRender')->name('verRender');
                Route::get('/admin/firmas', 'firmas')->name('firmas');
                Route::get('/admin/firmasPendientes', 'firmasPendientes')->name('firmasPendientes');
                Route::get('/admin/recompensasRegistro', 'recompensas')->name('recompensas');

                Route::post('/admin/update',  'App\Http\Controllers\AdminController@adminUpdate')->name('update');
                
                Route::get('/admin/prestadoresProyectos', 'prestadoresProyectos')->name('prestadoresProyectos');
                Route::get('/admin/prestadoresProyectos2', 'prestadoresProyectos2')->name('prestadoresProyectos2');
                Route::get('/admin/prestadoresProyectos3', 'prestadoresProyectos3')->name('prestadoresProyectos3');
                Route::get('/admin/ProyectosCitados', 'ProyectosCitados')->name('ProyectosCitados');
                Route::get('/admin/prestadores_inactivos', 'prestadores_inactivos')->name('prestadores_inactivos');
                Route::get('/admin/prestadores_liberados', 'prestadores_liberados')->name('prestadores_liberados');
                Route::get('/admin/prestadores_terminados','prestadores_terminados')->name('prestadores_terminados');
                Route::get('/admin/actividades_revision', 'actividades_revision')->name('actividades_revision');
                Route::get('/admin/actividades_revision/{id}/detalles', 'actividadDetalles')->name('actividades.detalles');
                Route::get('/admin/actividades_revision/finalizar/{id}/{experiencia}', 'actividadRevisada')->name('actividadRevisada');
                Route::get('/admin/actividades_en_progreso','actividades_en_progreso')->name('actividades_en_progreso');
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

                // Route::get('/admin/registrovisitas', 'registroVisitas')->name('registrovisitas');
                // Route::get('/admin/visitas', 'visitas')->name('visitas');
                // Route::get('/admin/actividades_revision/{id}/detalles', 'actividadDetalles')->name('actividad.detalles');
                // Route::get('/admin/actividades_revision/{id}', 'finalizarActividad')->name('finalizar.actividad');
                // Route::get('/actividad-revisada/{id}/{experiencia}', 'vistaFinalizacionActividad')->name('admin.actividadRevisada');
            });
       });
});

//Rutas Prestador
Route::controller(App\Http\Controllers\PrestadorController::class)->group(function(){

    Route::post('prestador/nota', 'guardarNota')->middleware('role:Superadmin')->name('nota');
    Route::post('prestador/horario_guardar', 'horario_guardar')->middleware('role:prestador,admin,Superadmin')->name('horario_guardar');
    // Route::post('/marcar', 'marcar')->middleware('role:admin,checkin,Superadmin')->name('marcar');

    Route::name('api.')->group(function () {
        Route::post('/marcar', 'marcar')->middleware('role:admin,checkin,Superadmin,encargado')->name('marcar');
        Route::post('/afirmas', 'asignarfirmas')->name('afirmas');    
    });
    
    Route::middleware('role:prestador,voluntario,practicante,encargado')->group(function() {
        Route::get('prestador/home', 'home')->name('homeP');

        Route::get('prestador/reportes_parciales', 'show_reportes')->name('parciales');
        Route::post('prestador/subir_reporte_parcial', 'subir_reportes_parciales')->name('subirReporte');
        Route::get('prestador/eliminar_reporte_parcial/{id}', 'eliminar_reportes_parciales')->name('eliminarReporte');

        Route::get('prestador/registro_impresion', 'create_imps')->name('create_imps');
        Route::post('prestador/registrar_impresion', 'register_imps')->name('register_imps');
        Route::get('prestador/mostrar_mis_impresiones', 'show_imps')->name('show_imps');

        Route::get('/prestador/home/perfil', 'perfil')->name('perfil');
        Route::post('/prestador/home/perfil/cambiar-imagen-perfil', 'cambiarImagenPerfil')->name('cambiarImagenPerfil');

        Route::get('/prestador/cambiarRol', 'cambiarRol')->name('cambiarRol');

        Route::get('prestador/horas', 'horas')->name('horas');
        Route::post('prestador/completar_impresion','completar_impresion')->name('completar_impresion');
        Route::post('prestador/completar_actividad', 'completar_actividad')->name('completar_actividad');
        Route::get('prestador/completar_impresion_tabla', 'prestadoresProyectosCompletados')->name('prestadoresProyectosCompletados');
        Route::get('prestador/completar_actividad_tabla', 'Pactividadterminada')->name('Pactividadterminada');
        Route::get('prestador/horario', 'horario')->name('horario');
        Route::get('prestador/registro_reporte', 'registro_reporte')->name('registro_reporte');
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

        // Route::get('/proyectospendientes', 'proyectos')->name('proyectos');
        // Route::get('/proyectos_prendientes', 'proyectos_prendientes')->name('proyectos_prendientes');
        Route::get('/prestador/asistencias', 'asistencias')->name('asistencias');
        Route::get('/prestador/faltas', 'faltas')->name('faltas');
        Route::post('prestador/cancelacion_prestador', 'cancelacion_prestador')->name('cancelacion_prestador');
    });

});

Route::controller(App\Http\Controllers\MedallasController::class)->group(function(){
    Route::get('/medallas', 'index')->name('medallas');
    Route::post('/prestadores/{userId}/asignar-medallas', 'asignarMedallas');
    Route::get('/prestadores/medallas','obtenerMedallasUsuario');
    Route::post('/prestadores/{userId}/desasignar-medallas','desasignarMedallas');
    Route::post('/prestadores/{userId}/desasignar-medallas', 'crearMedalla');
});

Route::controller(App\Http\Controllers\HomeController::class)->group(function(){
    //Route::post('/crearImpresion', 'crearImpresion')->middleware('guest')->name('crearImpresion'); <--- registro de las solicitudes de impresion 3D
    Route::post('update', 'update')->name('update');
    Route::get('modificaradmin', 'modificaradmin')->name('modificaradmin');
    Route::post('/cliente/reg', 'registro_impresion_form')->name('formulariof');
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

            Route::get('/cliente/solicitud_capacitacion', 'solicitud_capacitacion')->name('solicitud_capacitacion');
            Route::get('/cliente/solicitud_impresion', 'solicitud_impresion')->name('solicitud_impresion');
        // Route::get('/visita','visita')->name('visitas');
        });    
    });
    Route::name('api.')->group(function () {
        Route::post('visitator', 'registrarVisita')->middleware('role:encargado,admin,checkin,Superadmin')->name('registrarVisita');
    });
});

Route::controller(App\Http\Controllers\empController::class)->group(function(){
    Route::name('ss.')->group(function () {

        Route::get('/sshorasP', 'sshorasP')->name('sshorasP');
        Route::get('/ssprestadoresA', 'ssPrestadoresA')->name('ssPrestadoresA');
        Route::get('/ssprestadoresP','ssPrestadoresP')->name('ssPrestadoresP');
        Route::get('/ssclientes', 'ssClientes')->name('ssClientes');
        Route::get('/ssadministradores', 'ssAdministradores')->name('ssAdministradores');
        Route::get('/sscitas', 'ssCitas')->name('ssCitas');
        Route::get('/sscitas_pendientes', 'ssCitas_pendientes')->name('ssCitas_pendientes');
        Route::get('/ssFirmaspendientes', 'ssFirmaspendientes')->name('ssFirmaspendientes');
        Route::get('/sstablavisitas', 'sstablavisitas')->name('sstablavisitas');
        Route::get('/sstablausuarios', 'sstablaUserGeneral')->name('sstablausuarios');
        Route::get('/ssPrestadoresProyectos', 'ssPrestadoresProyectos')->name('ssPrestadoresProyectos');
        Route::get('/ssPrestadoresProyectosTerminados','ssPrestadoresProyectosTerminados')->name('ssPrestadoresProyectosTerminados');
        Route::get('/ssPrestadoresProyectosTerminados2', 'ssPrestadoresProyectosTerminados2')->name('ssPrestadoresProyectosTerminados2');
        Route::get('/ssActividad', 'ssActividad')->name('ssActividad');
        Route::get('/ssActividadProgreso', 'ssActividadProgreso')->name('ssActividadProgreso');
        Route::get('/ssProyectosCitados', 'ssProyectosCitados')->name('ssProyectosCitados');
        Route::get('/ssprestadoresI','ssPrestadoresI')->name('ssPrestadoresI');
        Route::get('/ssprestadoresT','ssPrestadoresT')->name('ssPrestadoresT');
        Route::get('/ssprestadoresL', 'ssPrestadoresL')->name('ssPrestadoresL');
        Route::get('/ssActividadR', 'ssActividadR')->name('ssActividadR');
        Route::get('/ssActividadT', 'ssActividadT')->name('ssActividadT');
        Route::get('/ssActividadCanceladas', 'ssActividadCanceladas')->name('ssActividadCanceladas');
        Route::get('/ssActividadT_personal','ssActividadT_personal')->name('ssActividadT_personal');
        Route::get('/ssActividadP_personal','ssActividadP_personal')->name('ssActividadP_personal');
        Route::get('/ssActividadR_personal', 'ssActividadR_personal')->name('ssActividadR_personal');
        Route::get('/ssFaltas', 'ssFaltas')->name('ssFaltas');
        Route::get('/ssdiasfestivos', 'ssDiasFestivos')->name('ssDiasFestivos');
        Route::get('/sshorario', 'sshorario')->name('sshorario');
        Route::get('/sstablaprestadores', 'sstablaprestadores')->name('sstablaprestadores')->middleware('role:admin,Superadmin,prestador');
        Route::get('/ssImpresionesTerminadas','ssImpresionesTerminadas')->name('ssImpresionesTerminadas')->middleware('role:prestador');
        Route::get('/ssActividadTerminada', 'ssActividadTerminada')->name('ssActividadTerminada')->middleware('role:prestador');
        // Route::get('/ssActividadCreada', 'ssActividadCreada')->name('ssActividadCreada')->middleware('role:prestador');
    });
});

Route::controller(App\Http\Controllers\MailController::class)->group(function(){
    Route::name('email.')->group(function () {
        Route::middleware('guest')->group(function() {
            Route::get('visitante/correo', 'sendEmail')->name('impresion');
        });
    });
});

Route::get('/bot', function () {
    return view('boot');
});

Route::match(['get', 'post'], '/botman', [App\Http\Controllers\BotManController::class, 'handle']);

/*
Route::get('/registroImpresion',[App\Http\Controllers\HomeController::class, 'registroImpresion'])->middleware('guest')->name('registroImpresion');
Route::post('/crearImpresion', [App\Http\Controllers\HomeController::class, 'crearImpresion'])->name('crearImpresion')->middleware('guest');
Route::post('update', 'App\Http\Controllers\HomeController@update')->name('update');
Route::get('modificaradmin', 'App\Http\Controllers\HomeController@modificaradmin')->name('modificaradmin');

Route::get('/medallas', [MedallasController::class, 'index']);
Route::post('/prestadores/{userId}/asignar-medallas', [MedallasController::class, 'asignarMedallas']);
Route::get('/prestadores/medallas', [MedallasController::class, 'obtenerMedallasUsuario']);
Route::post('/prestadores/{userId}/desasignar-medallas', [MedallasController::class, 'desasignarMedallas']);
Route::post('/prestadores/{userId}/desasignar-medallas', [MedallasController::class, 'crearMedalla']);

//Rutas api
Route::name('api.')->group(function () {
    Route::post('/marcar', [App\Http\Controllers\PrestadorController::class, 'marcar'])->middleware('role:admin,checkin,Superadmin')->name('marcar');
    Route::post('/afirmas', [App\Http\Controllers\PrestadorController::class, 'asirgarfirmas'])->name('afirmas');
    Route::post('/actualizar', [App\Http\Controllers\AdminController::class, 'guardar'])->name('actualizar');
    Route::post('/actualizarb', [App\Http\Controllers\AdminController::class, 'guardar2'])->name('actualizarb');
    Route::post('/actualizarcursos1', [App\Http\Controllers\AdminController::class, 'guardarcursos1'])->name('actualizarcursos1');
    Route::post('/actualizarcursos2', [App\Http\Controllers\AdminController::class, 'guardarcursos2'])->name('actualizarcursos2');
    Route::post('/actualizarcursos3', [App\Http\Controllers\AdminController::class, 'guardarcursos3'])->name('actualizarcursos3');
    Route::post('/actualizarstatus', [App\Http\Controllers\AdminController::class, 'guardarstatus'])->name('actualizarstatus');
    Route::post('/eliminar', [App\Http\Controllers\AdminController::class, 'destroy'])->name('eliminar');
    Route::post('/activar', [App\Http\Controllers\AdminController::class, 'activar'])->name('activar');
    Route::post('/cita_programar', [App\Http\Controllers\AdminController::class, 'cita_programar'])->name('cita_programar');
    Route::post('/cita_programar_2', [App\Http\Controllers\AdminController::class, 'cita_programar_2'])->name('cita_programar_2');
    Route::post('/cita_programar_3', [App\Http\Controllers\AdminController::class, 'cita_programar_3'])->name('cita_programar_3');
    Route::post('/create_premios', [App\Http\Controllers\AdminController::class, 'create_premios'])->name('create_premios');
    Route::get('/check-in', [App\Http\Controllers\HomeController::class, 'checkin'])->name('checkin')->middleware('role:checkin');
    Route::post('/prestadores_asignados', [App\Http\Controllers\AdminController::class, 'prestadores_asignados'])->name('prestadores_asignados');
    Route::post('/impresion_terminada', [App\Http\Controllers\AdminController::class, 'impresion_terminada'])->name('impresion_terminada');
    Route::post('/documento', [App\Http\Controllers\AdminController::class, 'documento'])->name('documento');
    Route::post('/actividad_asignada', [App\Http\Controllers\AdminController::class, 'actividad_asignada'])->name('actividad_asignada');
    Route::post('/actividad_reasignada', [App\Http\Controllers\AdminController::class, 'actividad_reasignada'])->name('actividad_reasignada');
    Route::post('/agregar_categoria_y_actividad', [App\Http\Controllers\AdminController::class, 'agregarCategoriaActividad'])->name('agregarCategoriaActividad');
    Route::post('/desactivar_prestadores', [App\Http\Controllers\AdminController::class, 'desactivar_prestadores'])->name('desactivar_prestadores');
    Route::post('/activar_prestadores', [App\Http\Controllers\AdminController::class, 'activar_prestadores'])->name('activar_prestadores');
    Route::post('/denegar_impresion', [App\Http\Controllers\AdminController::class, 'denegar_impresion'])->name('denegar_impresion');
    Route::post('/impresion_marcha', [App\Http\Controllers\AdminController::class, 'impresion_marcha'])->name('impresion_marcha');
    Route::post('/eliminar_prestadores_impresion', [App\Http\Controllers\AdminController::class, 'eliminar_prestadores_impresion'])->name('eliminar_prestadores_impresion');
    Route::post('/proyectos_prestador_terminados', [App\Http\Controllers\AdminController::class, 'proyectos_prestador_terminados'])->name('proyectos_prestador_terminados');
    Route::post('/terminar_prestadores', [App\Http\Controllers\AdminController::class, 'terminar_prestadores'])->name('terminar_prestadores');
    Route::post('/admin/guardardias', [App\Http\Controllers\AdminController::class, 'guardardiafestivo'])->name('guardardiasfestivos');
    Route::post('/admin/eliminardias', [App\Http\Controllers\AdminController::class, 'eliminardiafestivo'])->name('eliminardiafestivo');
    Route::post('/admin/eliminarhorario', [App\Http\Controllers\AdminController::class, 'eliminarhorario'])->name('eliminarhorario');
    Route::post('/admin/guardarhorario', [App\Http\Controllers\AdminController::class, 'guardarhorario'])->name('guardarhorario');

    // Route::post('/registrovisita', [App\Http\Controllers\AdminController::class, 'registrarVisitas'])->name('registrarVisitas');
    // Route::post('/salidaVisita', [App\Http\Controllers\AdminController::class, 'salidaVisita'])->name('salidaVisita');
 
});

//Rutas Prestador
Route::get('/prestador/home', [App\Http\Controllers\PrestadorController::class, 'horas'])->middleware('role:prestador');
// Route::get('/proyectospendientes', [App\Http\Controllers\PrestadorController::class, 'proyectos'])->name('proyectos')->middleware('role:prestador');
// Route::get('/proyectos_prendientes', [App\Http\Controllers\PrestadorController::class, 'proyectos_prendientes'])->name('proyectos_prendientes')->middleware('role:prestador');
Route::post('prestador/nota', [App\Http\Controllers\PrestadorController::class, 'guardarNota'])->middleware('role:Superadmin')->name('nota');
Route::post('prestador/completar_impresion', [App\Http\Controllers\PrestadorController::class, 'completar_impresion'])->middleware('role:prestador')->name('completar_impresion');
Route::post('prestador/completar_actividad', [App\Http\Controllers\PrestadorController::class, 'completar_actividad'])->middleware('role:prestador')->name('completar_actividad');
Route::get('prestador/completar_impresion_tabla', [App\Http\Controllers\PrestadorController::class, 'prestadoresProyectosCompletados'])->middleware('role:prestador')->name('prestadoresProyectosCompletados');
Route::get('prestador/completar_actividad_tabla', [App\Http\Controllers\PrestadorController::class, 'Pactividadterminada'])->middleware('role:prestador')->name('Pactividadterminada');
Route::get('prestador/horario', [App\Http\Controllers\PrestadorController::class, 'horario'])->middleware('role:prestador')->name('horario');
Route::get('prestador/regitro_reporte', [App\Http\Controllers\PrestadorController::class, 'regitro_reporte'])->middleware('role:prestador')->name('regitro_reporte');
Route::get('prestador/obtenerActividades', [App\Http\Controllers\PrestadorController::class, 'obtenerActividades'])->middleware('role:prestador')->name('obtenerActividades');
Route::get('prestador/actividades_prestadores', [App\Http\Controllers\PrestadorController::class, 'actividades_prestadores'])->middleware('role:prestador')->name('actividades_prestadores');
Route::post('prestador/horario_guardar', [App\Http\Controllers\PrestadorController::class, 'horario_guardar'])->middleware('role:prestador,admin,Superadmin')->name('horario_guardar');
Route::post('prestador/regitro_reporte_guardar', [App\Http\Controllers\PrestadorController::class, 'regitro_reporte_guardar'])->middleware('role:prestador')->name('regitro_reporte_guardar');
Route::put('prestador/actividades_prestadores/{id}', [App\Http\Controllers\PrestadorController::class, 'contarTiempoActividad'])->middleware('role:prestador')->name('contarTiempoActividad');
Route::put('prestador/actividades_prestadores/{id_actividad}', [App\Http\Controllers\PrestadorController::class, 'finalizarActividad'])->middleware('role:prestador')->name('finalizarActividad');
Route::get('prestador/actividades_creadas', [App\Http\Controllers\PrestadorController::class, 'actividades_creadas'])->name('actividades_creadas')->middleware('role:prestador');
Route::put('prestador/actividades_creadas/{id}', [App\Http\Controllers\PrestadorController::class, 'enProcesoActividad'])->name('enProcesoActividad')->middleware('role:prestador');
Route::get('prestador/actividades_en_proceso', [App\Http\Controllers\PrestadorController::class, 'actividades_en_proceso'])->middleware('role:prestador')->name('actividades_en_proceso');
Route::get('prestador/actividades_terminadas', [App\Http\Controllers\PrestadorController::class, 'actividadesTerminadas'])->middleware('role:prestador')->name('actividadesTerminadas');
Route::put('prestador/actividades_terminadas/{id_actividad}', [App\Http\Controllers\PrestadorController::class, 'terminarActividad'])->middleware('role:prestador')->name('terminarActividad');
Route::get('prestador/actividades_prestadores_revisadas', [App\Http\Controllers\PrestadorController::class, 'actividades_prestadores_revisadas'])->middleware('role:prestador')->name('actividades_prestadores_revisadas');
Route::get('prestador/actividades_canceladas', [App\Http\Controllers\PrestadorController::class, 'actividades_canceladas'])->middleware('role:prestador')->name('actividades_canceladas');
Route::put('prestador/actividades_creadas/{id_actividad}', [App\Http\Controllers\PrestadorController::class, 'retomarActividad'])->name('retomarActividad')->middleware('role:prestador');

Route::get('/prestador/home/perfil', [App\Http\Controllers\PrestadorController::class, 'perfil'])->name('perfil')->middleware('role:prestador');
Route::post('/prestador/home/perfil/cambiar-imagen-perfil', [App\Http\Controllers\PrestadorController::class, 'cambiarImagenPerfil'])->middleware('role:prestador')->name('cambiarImagenPerfil');

Route::post('prestador/cancelacion_prestador', [App\Http\Controllers\PrestadorController::class, 'cancelacion_prestador'])->middleware('role:prestador')->name('cancelacion_prestador');


Route::name('admin.')->group(function () {
    Route::get('/admin/faltas', [App\Http\Controllers\AdminController::class, 'faltas'])->name('faltas');
    Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'firmas'])->name('home');
    Route::get('/admin/registro', [App\Http\Controllers\AdminController::class, 'registro'])->name('registro');
    Route::get('/admin/modificar', 'App\Http\Controllers\AdminController@modificar')->name('modificar');
    Route::get('/admin/prestadores', [App\Http\Controllers\AdminController::class, 'prestadores'])->name('prestadores');
    Route::get('/admin/administradores', [App\Http\Controllers\AdminController::class, 'administradores'])->name('administradores')->middleware('role:Superadmin');
    Route::get('/admin/clientes', [App\Http\Controllers\AdminController::class, 'clientes'])->name('clientes');
    Route::get('/admin/citas', [App\Http\Controllers\AdminController::class, 'citas'])->name('citas');
    Route::get('/admin/citas_pendientes', [App\Http\Controllers\AdminController::class, 'citas_pendientes'])->name('citas_pendientes');
    Route::get('/admin/prestadoresPendientes', [App\Http\Controllers\AdminController::class, 'prestadoresPendientes'])->name('prestadoresPendientes');
    Route::post('/admin/descargarArchivo', [App\Http\Controllers\AdminController::class, 'descargarArchivo'])->name('descargarArchivo');
    Route::post('/admin/verImagenCredencial', [App\Http\Controllers\AdminController::class, 'verCredencial'])->name('verCredencial');
    Route::post('/admin/verImagenRender', [App\Http\Controllers\AdminController::class, 'verRender'])->name('verRender');
    Route::get('/admin/firmas', [App\Http\Controllers\AdminController::class, 'firmas'])->name('firmas');
    Route::get('/admin/firmasPendientes', [App\Http\Controllers\AdminController::class, 'firmasPendientes'])->name('firmasPendientes');
    Route::get('/admin/recompensasRegistro', [App\Http\Controllers\AdminController::class, 'recompensas'])->name('recompensas');
    Route::get('/admin/C_actividades', [App\Http\Controllers\AdminController::class, 'C_Actividades'])->name('C_Actividades');
    Route::get('/admin/newCategoriaYActividad', [App\Http\Controllers\AdminController::class, 'newCategoriaYActividad'])->name('newCategoriaYActividad');
    Route::get('/admin/actividades', [App\Http\Controllers\AdminController::class, 'actividades'])->name('actividades');
    Route::get('/admin/check-in', [App\Http\Controllers\AdminController::class, 'checkin'])->name('checkin');
    Route::get('/admin/premios', [App\Http\Controllers\AdminController::class, 'premios'])->name('premios');
    Route::post('/admin/update', 'App\Http\Controllers\AdminController@adminUpdate')->name('update');
    Route::get('/admin/general', [App\Http\Controllers\AdminController::class, 'general'])->name('general');
    Route::get('/admin/prestadoresProyectos', [App\Http\Controllers\AdminController::class, 'prestadoresProyectos'])->name('prestadoresProyectos');
    Route::get('/admin/prestadoresProyectos2', [App\Http\Controllers\AdminController::class, 'prestadoresProyectos2'])->name('prestadoresProyectos2');
    Route::get('/admin/prestadoresProyectos3', [App\Http\Controllers\AdminController::class, 'prestadoresProyectos3'])->name('prestadoresProyectos3');
    Route::get('/admin/ProyectosCitados', [App\Http\Controllers\AdminController::class, 'ProyectosCitados'])->name('ProyectosCitados');
    Route::get('/admin/prestadores_inactivos', [App\Http\Controllers\AdminController::class, 'prestadores_inactivos'])->name('prestadores_inactivos');
    Route::get('/admin/prestadores_liberados', [App\Http\Controllers\AdminController::class, 'prestadores_liberados'])->name('prestadores_liberados');
    Route::get('/admin/prestadores_terminados', [App\Http\Controllers\AdminController::class, 'prestadores_terminados'])->name('prestadores_terminados');
    Route::get('/admin/actividades_revision', [App\Http\Controllers\AdminController::class, 'actividades_revision'])->name('actividades_revision');
    Route::get('/admin/actividades_revision/{id}/detalles', [App\Http\Controllers\AdminController::class, 'actividadDetalles'])->name('actividades.detalles');
    Route::get('/admin/actividades_revision/finalizar/{id}/{experiencia}', [App\Http\Controllers\AdminController::class, 'actividadRevisada'])->name('actividadRevisada');
    Route::get('/admin/actividades_en_progreso', [App\Http\Controllers\AdminController::class, 'actividades_en_progreso'])->name('actividades_en_progreso');
    Route::post('/admin/terminar_actividad', [App\Http\Controllers\AdminController::class, 'terminar_actividad'])->name('terminar_actividad');
    Route::post('/admin/actividad_cancelar', [App\Http\Controllers\AdminController::class, 'actividad_cancelar'])->name('actividad_cancelar');
    Route::get('/admin/tabla_terminados', [App\Http\Controllers\AdminController::class, 'tabla_terminados'])->name('tabla_terminados');
    Route::get('/admin/tabla_actividades_canceladas', [App\Http\Controllers\AdminController::class, 'tabla_actividades_canceladas'])->name('tabla_actividades_canceladas');
    Route::post('/admin/mod', [App\Http\Controllers\AdminController::class, 'actividad_modificar'])->name('actividad_modificar');
    Route::post('/admin/reasignar', [App\Http\Controllers\AdminController::class, 'actividad_cancelada'])->name('actividad_cancelada');
    Route::post('/admin/participantes', [App\Http\Controllers\AdminController::class, 'participantes'])->name('participantes');
    Route::get('/admin/horario', [App\Http\Controllers\AdminController::class, 'horarioadmin'])->name('horarioadmin');
    Route::post('prestador/horario_guardar_admin', [App\Http\Controllers\AdminController::class, 'horario_guardar_admin'])->middleware('role:prestador,admin,Superadmin')->name('horario_guardar_admin');
    Route::get('/admin/veractividades', [App\Http\Controllers\AdminController::class, 'veractividades'])->name('veractividades');
    Route::get('/admin/veractividades_pendientes', [App\Http\Controllers\AdminController::class, 'veractividades_pendientes'])->name('veractividades_pendientes');
    Route::get('/admin/veractividades_completadas', [App\Http\Controllers\AdminController::class, 'veractividades_completadas'])->name('veractividades_completadas');
    Route::get('/admin/cambiorol',[App\Http\Controllers\AdminController::class, 'cambiarRol'])->name('cambiorol');
    Route::get('/admin/Dias_no_laborables', [App\Http\Controllers\AdminController::class, 'diasfestivos'])->name('diasfestivos');
    Route::get('/admin/horarios', [App\Http\Controllers\AdminController::class, 'horarios'])->name('horarios');
    Route::get('/admin/obtenerActividades', [App\Http\Controllers\AdminController::class, 'obtenerActividades'])->middleware('role:admin, Superadmin')->name('obtenerActividades');
});

Route::name('cliente.')->group(function () {
    Route::get('/home',[App\Http\Controllers\VisitanteController::class, 'principal'])->name('home')->middleware('role:clientes');
    Route::get('/registro',[App\Http\Controllers\VisitanteController::class, 'registro'])->name('registro');
    Route::post('/confirmar_cita',[App\Http\Controllers\VisitanteController::class, 'confirmar_cita'])->name('confirmar_cita')->middleware('role:clientes');
    Route::post('/cita',[App\Http\Controllers\VisitanteController::class, 'guardarCita'])->name('cita')->middleware('role:clientes');
    Route::post('/visitaguardar',[App\Http\Controllers\VisitanteController::class, 'guardarVisita'])->name('guardarVisita')->middleware('role:clientes');
    Route::get('/visitas',[App\Http\Controllers\VisitanteController::class, 'principal'])->name('visitas')->middleware('role:clientes');

     // Route::get('/visita',[App\Http\Controllers\VisitanteController::class,'visita'])->name('visitas')->middleware('role:clientes');

});

Route::name('email.')->group(function () {
    Route::get('impresion', function () {

        $details = [
            'title' => 'Solicitud de impresion',
            'body' => 'mensaje de prueba para la solicitud de impresion'
         ];

      \Mail::to('eduardo.guerrero7430@alumnos.udg.mx')->send(new \App\Mail\Email($details));

         dd("Email is Sent.");
    })->name('impresion');
});


*/






