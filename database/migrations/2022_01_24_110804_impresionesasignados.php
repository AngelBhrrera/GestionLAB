<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Impresionesasignados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW `impresionesasignados` AS SELECT
        `proyectos_prestadores`.`id_prestador` AS `id_prestador`,
        `proyectos_prestadores`.`id_proyecto` AS `id_proyecto`,
        `proyectos_prestadores`.`id` AS `id_impresion_prestador`,
        `proyectos_prestadores`.`status` AS `status_impresion`,
        `cita_clientes`.`id` AS `id_cliente`,
        `cita_clientes`.`correo` AS `correo_cliente`,
        `cita_clientes`.`nombre` AS `nombre_cliente`,
        `cita_clientes`.`telefono` AS `telefono_cliente`,
        `cita_clientes`.`proyecto` AS `Nombre_Proyecto`,
        `cita_clientes`.`enlaceDrive` AS `enlaceDrive`,
        `cita_clientes`.`N_piezas` AS `N_piezas`,
        `cita_clientes`.`observaciones` AS `observaciones`,
        `cita_clientes`.`fecha` AS `fecha`,
        `cita_clientes`.`status` AS `status`,
        `cita_clientes`.`palabrasClave` AS `palabrasClave`,
        `cita_clientes`.`introduccion` AS `introduccion`,
        `cita_clientes`.`trabajosRelacionados` AS `trabajosRelacionados`,
        `cita_clientes`.`propuesta` AS `propuesta`,
        `cita_clientes`.`conclusion` AS `conclusion`,
        `cita_clientes`.`fechacita` AS `fechacita`
    FROM
        (
            `proyectos_prestadores`JOIN `cita_clientes` ON(
                `proyectos_prestadores`.`id_proyecto` =`cita_clientes`.`id_citas`
            ));"
         ) ;

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
