<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RegistrosCheckInPendientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW registros_checkin_pendientes AS
        SELECT
        `registros_checkin`.`id` AS `id`,

        `registros_checkin`.`idusuario` AS `idusuario`,
        `registros_checkin`.`origen` AS `origen`,
        `registros_checkin`.`responsable` AS `responsable`,
        `registros_checkin`.`encargado_id` AS `idencargado`,

        `registros_checkin`.`fecha` AS `fecha`,
        `registros_checkin`.`fecha_actual` AS `fecha_actual`,
        `registros_checkin`.`hora_entrada` AS `hora_entrada`,
        `registros_checkin`.`hora_salida` AS `hora_salida`,
        `registros_checkin`.`tiempo` AS `tiempo`,
        `registros_checkin`.`estado` AS `estado`,
        `registros_checkin`.`horas` AS `horas`
        FROM
            `registros_checkin`
        WHERE
                `registros_checkin`.`estado` = 'pendiente'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW registros_checkin_pendientes");
    }
}
