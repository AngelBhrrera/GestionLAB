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
                `semanas_prestador`.`semanas_actividad`,
                `user_level`.`max_nivel`,
                `user_level`.`ruta`,
                `users`.`imagen_perfil`,
                `seguimiento_horas_completo`.`horas_servicio` AS `horas_cumplidas`,
                `seguimiento_horas_completo`.`horas_restantes` AS `horas_restantes`
            FROM
                (SELECT * FROM `users` WHERE `tipo` IN ('prestador', 'practicante', 'voluntario', 'coordinador')) AS `users`
            LEFT JOIN `seguimiento_horas_completo` ON `users`.`id` = `seguimiento_horas_completo`.`id`
            LEFT JOIN `areas` ON `users`.`area` = `areas`.`id`
            LEFT JOIN `sedes` ON `users`.`sede` = `sedes`.`id_sede`
            LEFT JOIN `semanas_prestador` ON `semanas_prestador`.`idusuario` =  `users`.`id`
            LEFT JOIN `user_level` ON `user_level`.`id` =  `users`.`id`;
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
