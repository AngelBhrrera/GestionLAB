<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Horaspendientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW horaspendientes AS
        SELECT
        `horasprestadores`.`id` AS `id`,
        `horasprestadores`.`codigo` AS `codigo`,
        `horasprestadores`.`nombre` AS `nombre`,
        `horasprestadores`.`apellido` AS `apellido`,
        `horasprestadores`.`fecha` AS `fecha`,
        `horasprestadores`.`hora_entrada` AS `hora_entrada`,
        `horasprestadores`.`hora_salida` AS `hora_salida`,
        `horasprestadores`.`tiempo` AS `tiempo`,
        `horasprestadores`.`estado` AS `estado`,
        `horasprestadores`.`horas` AS `horas`,
        `horasprestadores`.`nota` AS `nota`,
        `horasprestadores`.`fecha_actual` AS `fecha_actual`,
        `horasprestadores`.`idusuario` AS `idusuario`,
        `horasprestadores`.`origen` AS `origen`,
        `horasprestadores`.`responsable` AS `responsable`,
        `horasprestadores`.`srcimagen` AS `srcimagen`

    FROM
        `horasprestadores`
    WHERE
        (
            `horasprestadores`.`estado` = 'pendiente'
        )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horaspendientes');
    }
}
