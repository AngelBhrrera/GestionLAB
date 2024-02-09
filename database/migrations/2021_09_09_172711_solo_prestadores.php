<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Soloprestadores extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW solo_prestadores AS
            SELECT
                `users`.`id` AS `id`,
                `users`.`name` AS `name`,
                `users`.`apellido` AS `apellido`,
                `users`.`correo` AS `correo`,
                `users`.`codigo` AS `codigo`,
                `users`.`tipo` AS `tipo`,
                `users`.`sede` AS `id_sede`,
                `sedes`.`nombre_sede`,
                `users`.`area` AS `id_area`,
                `areas`.`nombre_area`,
                `users`.`horario` AS `horario`,
                `users`.`carrera` AS `carrera`,
                `users`.`horas` AS `horas`,
                `cuenta_horas`.`horas_servicio` AS `horas_cumplidas`,
                `cuenta_horas`.`horas_restantes` AS `horas_restantes`,
                `users`.`encargado_id` AS `encargado_id`
            FROM
                `users`
            LEFT JOIN `cuenta_horas` ON `users`.`id` = `cuenta_horas`.`id`
            LEFT JOIN `areas` ON `users`.`area` = `areas`.`id`
            LEFT JOIN `sedes` ON `users`.`sede` = `sedes`.`id_sede`
            WHERE
                `users`.`tipo` IN ('prestador', 'practicante', 'voluntario', 'encargado');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW solo_prestadores");
    }
}
