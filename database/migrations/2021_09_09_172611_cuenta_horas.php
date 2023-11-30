<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cuentahoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW cuenta_horas AS 
        SELECT
        `horasprestadores`.`codigo` AS `codigo`,
        SUM(`horasprestadores`.`horas`) AS `horas_servicio`,
        (
            `users`.`horas` - SUM(`horasprestadores`.`horas`)
        ) AS `horas_restantes`
        FROM
            (
                `users`
            JOIN `horasprestadores` ON
                (
                    (
                        `users`.`id` = `horasprestadores`.`idusuario`
                    )
                )
            )
        WHERE
            (
                `horasprestadores`.`estado` = 'autorizado'
            )
        GROUP BY
            `horasprestadores`.`codigo`,
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
