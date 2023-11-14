<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PrestadoresImpresiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        \DB::statement("
        CREATE VIEW `prestadores_impresiones`
         AS SELECT
        `users`.`name` AS `nombre_prestador`,
        `users`.`apellido` AS `apellido_prestador`,
        `users`.`codigo` AS `codigo_prestador`,
        `users`.`correo` AS `correo_prestador`,
        `impresionesasignados`.`id_prestador` AS `id_prestador`,
        `impresionesasignados`.`id_proyecto` AS `id_proyecto`,
        `impresionesasignados`.`id_cliente` AS `id_cliente`,
        `impresionesasignados`.`correo_cliente` AS `correo_cliente`,
        `impresionesasignados`.`nombre_cliente` AS `nombre_cliente`,
        `impresionesasignados`.`telefono_cliente` AS `telefono_cliente`,
        `impresionesasignados`.`Nombre_Proyecto` AS `Nombre_Proyecto`,
        `impresionesasignados`.`enlaceDrive` AS `enlaceDrive`,
        `impresionesasignados`.`N_piezas` AS `N_piezas`,
        `impresionesasignados`.`observaciones` AS `observaciones`,
        `impresionesasignados`.`fecha` AS `fecha`,
        `impresionesasignados`.`status` AS `status`,
        `impresionesasignados`.`palabrasClave` AS `palabrasClave`,
        `impresionesasignados`.`introduccion` AS `introduccion`,
        `impresionesasignados`.`trabajosRelacionados` AS `trabajosRelacionados`,
        `impresionesasignados`.`propuesta` AS `propuesta`,
        `impresionesasignados`.`conclusion` AS `conclusion`,
        `impresionesasignados`.`fechacita` AS `fechacita`,
        `impresionesasignados`.`id_impresion_prestador` AS `id_impresion_prestador`,
        `impresionesasignados`.`status_impresion` AS `status_impresion`
        FROM (`impresionesasignados` join `users` on((`impresionesasignados`.`id_prestador` = `users`.`id`))) ;
       ") ;




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
