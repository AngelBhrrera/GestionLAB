<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Cuentahoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW cuenta_horas AS 
            SELECT
            `users`.`id` AS `id`,
            COALESCE(SUM(CASE WHEN `registros_checkin`.`estado` = 'autorizado' THEN `registros_checkin`.`horas` ELSE 0 END), 0) AS `horas_servicio`,
            (
                `users`.`horas` - COALESCE(SUM(CASE WHEN `registros_checkin`.`estado` = 'autorizado' THEN `registros_checkin`.`horas` ELSE 0 END), 0)
            ) AS `horas_restantes`,
            CASE
                WHEN EXISTS (
                    SELECT 1
                    FROM `registros_checkin`
                    WHERE `registros_checkin`.`idusuario` = `users`.`id`
                )
                THEN TRUE
                ELSE FALSE
            END AS `tiene_registros_checkin`
        FROM
            `users`
        LEFT JOIN `registros_checkin` ON `users`.`id` = `registros_checkin`.`idusuario`
        WHERE
            `users`.`tipo` IN ('prestador', 'coordinador', 'practicante', 'voluntario')
        GROUP BY
            `users`.`id`;
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW cuenta_horas");
    }
}
