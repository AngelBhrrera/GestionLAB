<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class soloclientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW solo_clientes AS
        SELECT
        `users`.`id` AS `id`,
        `users`.`name` AS `name`,
        `users`.`apellido` AS `apellido`,
        `users`.`correo` AS `correo`,
        `users`.`codigo` AS `codigo`
        FROM
            (
                `users`
            )
        WHERE
            (`users`.`tipo` = 'clientA') || (`users`.`tipo` = 'clientM') || (`users`.`tipo` = 'clientO')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement("DROP VIEW solo_clientes");
    }
}
