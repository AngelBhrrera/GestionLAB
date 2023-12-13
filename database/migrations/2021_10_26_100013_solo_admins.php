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
        `users`.`id` AS `id`, `users`.`name` AS `name`,
        `users`.`apellido` AS `apellido`,
        `users`.`correo` AS `correo`,
        `users`.`tipo` AS `tipo`
        FROM (`users`) 
        WHERE (`users`.`tipo` = 'admin')");
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
