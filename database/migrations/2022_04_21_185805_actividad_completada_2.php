<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActividadCompletada2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        \DB::statement("
        CREATE VIEW `actividad_completada_2`
        AS SELECT
            `c_actividad`.`id_actividad` AS `id_actividad`,
            `c_actividad`.`acti_id` AS `acti_id`,
            `c_actividad`.`id_prestador` AS `id_prestador`,
            `c_actividad`.`nombre_act` AS `nombre_act`,
            `c_actividad`.`tipo_act` AS `tipo_act`,
            `c_actividad`.`descripcion` AS `descripcion`,
            `c_actividad`.`objetivo` AS `objetivo`,
            `c_actividad`.`fecha` AS `fecha`,
            `c_actividad`.`status` AS `status`,
            `c_actividad`.`llave_actividad` AS `llave_actividad`,
            `c_actividad`.`encargado_id` AS `encargado_id`,
            `c_actividad`.`estimacion_tiempo` AS `estimacion_tiempo`,
            `c_actividad`.`duracion` AS `duracion`,
            `c_actividad`.`asignado_a` AS `asignado_a`
        FROM
            `c_actividad`
        WHERE
            (
                `c_actividad`.`status` = 'terminado'
            )

       ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
