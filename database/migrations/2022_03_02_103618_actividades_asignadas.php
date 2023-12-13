<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Actividadesasignadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW `actividades_asignadas` AS SELECT
        `actividades_prestadores`.`id_prestador` AS `id_prestador`,
        `actividades_prestadores`.`id_actividad` AS `llave_actividad`,
        `c_actividad`.`id_actividad` AS `id_actcreada`,
        `c_actividad`.`nombre_act` AS `nombre_act`,
        `c_actividad`.`tipo_act` AS `tipo_act`,
        `c_actividad`.`id_prestador` AS `id_prestador_asignado`,
        `c_actividad`.`descripcion` AS `descripcion`,
        `c_actividad`.`objetivo` AS `objetivo`,
        `c_actividad`.`fecha` AS `fecha`,
        `c_actividad`.`status` AS `status`,
        `c_actividad`.`fecha_realizada` AS `fecha_realizada`,
        `c_actividad`.`id_actividad` AS `id_llave`
        FROM
        (
            `actividades_prestadores`JOIN `c_actividad` ON(
                `actividades_prestadores`.`id_actividad` =`c_actividad`.`llave_actividad`
            ));"
         );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW actividades_asignadas");
    }
}
