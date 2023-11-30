<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prestadorespendientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW prestadores_pendientes AS
        SELECT
        `users`.`id` AS `id`,
        `users`.`name` AS `name`,
        `users`.`apellido` AS `apellido`,
        `users`.`correo` AS `correo`,
        `users`.`codigo` AS `codigo`,
        `users`.`tipo` AS `tipo`,
        `users`.`email_verified_at` AS `email_verified_at`,
        `users`.`password` AS `password`,
        `users`.`remember_token` AS `remember_token`,
        `users`.`created_at` AS `created_at`,
        `users`.`updated_at` AS `updated_at`
        FROM
            `users`
        WHERE
            (`users`.`tipo` = 'prestadorP')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW prestadores_pendientes");
    }
}
