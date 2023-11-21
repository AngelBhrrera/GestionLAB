<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Prestadoresterminado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW prestadoresterminados AS
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
        `users`.`carrera` AS `carrera`,
        `users`.`updated_at` AS `updated_at`,
        `users`.`horas` AS `horas`,
        `cuentahoras`.`horas_servicio` AS `horas_cumplidas`,
        `cuentahoras`.`horas_restantes` AS `horas_restantes`
        FROM
            (
                `users`
            LEFT JOIN `cuentahoras` ON
                (
                    (
                        `users`.`codigo` = `cuentahoras`.`codigo`
                    )
                )
            )
        WHERE
            (`users`.`tipo` = 'prestador' and `cuentahoras`.`horas_restantes` <= '0')
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestadoresterminados');
    }
}
