<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActividadTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        \DB::statement("
        CREATE VIEW `actividad_tabla`
         AS SELECT
        `users`.`name` AS `nombre_prestador`,
        `users`.`apellido` AS `apellido_prestador`,
        `users`.`codigo` AS `codigo_prestador`,
        `actividades_asignadas`.`id_prestador` AS `id_prestador`,
        `actividades_asignadas`.`llave_actividad` AS `llave_actividad`,
        `actividades_asignadas`.`id_actcreada` AS `id_actcreada`,
        `actividades_asignadas`.`nombre_act` AS `nombre_act`,
        `actividades_asignadas`.`tipo_act` AS `tipo_act`,
        `actividades_asignadas`.`descripcion` AS `descripcion`,
        `actividades_asignadas`.`objetivo` AS `objetivo`,
        `actividades_asignadas`.`fecha` AS `fecha`,
        `actividades_asignadas`.`status` AS `status`,
        `actividades_asignadas`.`fecha_realizada` AS `fecha_realizada`
        FROM (`actividades_asignadas` join `users` on((`actividades_asignadas`.`id_prestador` = `users`.`id`))) ;
       ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW actividad_tabla");
    }
}
