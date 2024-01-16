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
            `sede`.`nombre_Sede` AS `sede`
        FROM
            `users`
        INNER JOIN
            `sede` ON `users`.`sede` = `sede`.`id_Sede`
        WHERE
            `users`.`tipo` IN ('encargado', 'admin');
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
