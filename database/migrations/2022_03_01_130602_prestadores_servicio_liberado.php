<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class PrestadoresServicioLiberado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW prestadores_servicio_liberado AS
            SELECT
            `users`.`id` AS `id`,
            `users`.`name` AS `name`,
            `users`.`apellido` AS `apellido`,
            `users`.`correo` AS `correo`,
            `users`.`codigo` AS `codigo`,
            `users`.`tipo` AS `tipo`,
            `users`.`fecha_salida` AS `fecha_salida`,
            `cuenta_horas`.`horas_servicio` AS `horas_cumplidas`,
            `cuenta_horas`.`horas_restantes` AS `horas_restantes`,
            `users`.`horas` AS `horas`,
            `users`.`sede` AS `sede`,
            `users`.`area` AS `area`
            FROM
                (
                    `users` LEFT JOIN 
                    `cuenta_horas` ON
                        (
                            (
                                `users`.`id` = `cuenta_horas`.`id`
                            )
                        )
                )
            WHERE
                (`users`.`fecha_salida` IS NOT NULL)
                AND (`cuenta_horas`.`horas_restantes` <= 0)
        ");
    }

    public function down()
    {
        DB::statement("DROP VIEW prestadores_servicio_liberado");
    }
}
