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
        `registros_checkin`.`codigo` AS `codigo`,
        SUM(`registros_checkin`.`horas`) AS `horas_servicio`,
        (
            `users`.`horas` - SUM(`registros_checkin`.`horas`)
        ) AS `horas_restantes`
        FROM
            (
                `users`
            JOIN `registros_checkin` ON
                (
                    (
                        `users`.`id` = `registros_checkin`.`idusuario`
                    )
                )
            )
        WHERE
            (
                `registros_checkin`.`estado` = 'autorizado'
            )
        GROUP BY
            `registros_checkin`.`codigo`,
            `users`.`horas`
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
