<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ImpresionesPrestadoresPendientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW `impresiones_prestadores_pendientes`
        AS SELECT
        `prestadores_impresiones`.`nombre_prestador` AS `nombre_prestador`,
        `prestadores_impresiones`.`apellido_prestador` AS `apellido_prestador`,
        `prestadores_impresiones`.`codigo_prestador` AS `codigo_prestador`,
        `prestadores_impresiones`.`correo_prestador` AS `correo_prestador`,
        `prestadores_impresiones`.`id_prestador` AS `id_prestador`,
        `prestadores_impresiones`.`id_proyecto` AS `id_proyecto`,
        `prestadores_impresiones`.`id_cliente` AS `id_cliente`,
        `prestadores_impresiones`.`correo_cliente` AS `correo_cliente`,
        `prestadores_impresiones`.`nombre_cliente` AS `nombre_cliente`,
        `prestadores_impresiones`.`telefono_cliente` AS `telefono_cliente`,
        `prestadores_impresiones`.`Nombre_Proyecto` AS `Nombre_Proyecto`,
        `prestadores_impresiones`.`enlaceDrive` AS `enlaceDrive`,
        `prestadores_impresiones`.`N_piezas` AS `N_piezas`,
        `prestadores_impresiones`.`observaciones` AS `observaciones`,
        `prestadores_impresiones`.`fecha` AS `fecha`,
        `prestadores_impresiones`.`status` AS `status`,
        `prestadores_impresiones`.`palabrasClave` AS `palabrasClave`,
        `prestadores_impresiones`.`introduccion` AS `introduccion`,
        `prestadores_impresiones`.`trabajosRelacionados` AS `trabajosRelacionados`,
        `prestadores_impresiones`.`propuesta` AS `propuesta`,
        `prestadores_impresiones`.`conclusion` AS `conclusion`,
        `prestadores_impresiones`.`fechacita` AS `fechacita`,
        `prestadores_impresiones`.`id_impresion_prestador` AS `id_impresion_prestador`,
        `prestadores_impresiones`.`status_impresion` AS `status_impresion`
        FROM `prestadores_impresiones` WHERE (`prestadores_impresiones`.`status_impresion` = 'en proceso') ;

       ") ;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW impresiones_prestadores_pendientes");
    }
}
