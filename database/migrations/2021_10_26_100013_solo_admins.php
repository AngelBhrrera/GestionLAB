<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


class Soloadmins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW solo_admins AS
            SELECT
            `users`.`id` AS `id`,
            `users`.`name` AS `name`,
            `users`.`apellido` AS `apellido`,
            `users`.`correo` AS `correo`,
            `users`.`horario` AS `horario`,
            `users`.`telefono` AS `contacto`,
            `users`.`tipo` AS `tipo`,
            `sedes`.`nombre_sede` AS `sede`,
            `areas`.`nombre_area` AS `area`
        FROM
            `users`
        INNER JOIN `sedes` ON `users`.`sede` = `sedes`.`id_sede`
        INNER JOIN `areas` ON `users`.`area` = `areas`.`id`
        WHERE
            `users`.`tipo` IN ('coordinador', 'jefe area', 'jefe sede');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW solo_admins");
    }
}
