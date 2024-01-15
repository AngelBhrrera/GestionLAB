<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PrestadoresServicioConcluido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW prestadores_servicio_concluido AS
        SELECT
        `users`.`id` AS `id`,
        `users`.`name` AS `name`,
        `users`.`apellido` AS `apellido`,
        `users`.`correo` AS `correo`,
        `users`.`codigo` AS `codigo`,
        `users`.`tipo` AS `tipo`,
        `users`.`remember_token` AS `remember_token`,
        `users`.`carrera` AS `carrera`,
        `users`.`horas` AS `horas`,
        `cuenta_horas`.`horas_servicio` AS `horas_cumplidas`,
        `cuenta_horas`.`horas_restantes` AS `horas_restantes`
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
            (`cuenta_horas`.`horas_restantes` <= '0')
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW prestadores_servicio_concluido");
    }
}
