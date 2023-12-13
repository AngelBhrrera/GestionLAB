<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PrestadoresImpresiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("
        CREATE VIEW `prestadores_impresiones`
         AS SELECT
        `users`.`name` AS `nombre_prestador`,
        `users`.`apellido` AS `apellido_prestador`,
        `users`.`codigo` AS `codigo_prestador`,
        `users`.`correo` AS `correo_prestador`,
        `impresiones_asignados`.`id_prestador` AS `id_prestador`,
        `impresiones_asignados`.`id_proyecto` AS `id_proyecto`,
        `impresiones_asignados`.`id_cliente` AS `id_cliente`,
        `impresiones_asignados`.`correo_cliente` AS `correo_cliente`,
        `impresiones_asignados`.`nombre_cliente` AS `nombre_cliente`,
        `impresiones_asignados`.`telefono_cliente` AS `telefono_cliente`,
        `impresiones_asignados`.`Nombre_Proyecto` AS `Nombre_Proyecto`,
        `impresiones_asignados`.`enlaceDrive` AS `enlaceDrive`,
        `impresiones_asignados`.`N_piezas` AS `N_piezas`,
        `impresiones_asignados`.`observaciones` AS `observaciones`,
        `impresiones_asignados`.`fecha` AS `fecha`,
        `impresiones_asignados`.`status` AS `status`,
        `impresiones_asignados`.`palabrasClave` AS `palabrasClave`,
        `impresiones_asignados`.`introduccion` AS `introduccion`,
        `impresiones_asignados`.`trabajosRelacionados` AS `trabajosRelacionados`,
        `impresiones_asignados`.`propuesta` AS `propuesta`,
        `impresiones_asignados`.`conclusion` AS `conclusion`,
        `impresiones_asignados`.`fechacita` AS `fechacita`,
        `impresiones_asignados`.`id_impresion_prestador` AS `id_impresion_prestador`,
        `impresiones_asignados`.`status_impresion` AS `status_impresion`
        FROM (`impresiones_asignados` join `users` on((`impresiones_asignados`.`id_prestador` = `users`.`id`))) ;
       ") ;




    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW prestadores_impresiones");
    }
}
