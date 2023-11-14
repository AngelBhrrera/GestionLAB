<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActividadTerminada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
        CREATE VIEW `actividad_terminada`
         AS SELECT
        `users`.`name` AS `nombre_prestador`,
        `users`.`apellido` AS `apellido_prestador`,
        `users`.`codigo` AS `codigo_prestador`,
        `actividadesasignadas`.`id_prestador` AS `id_prestador`,
        `actividadesasignadas`.`llave_actividad` AS `llave_actividad`,
        `actividadesasignadas`.`id_actcreada` AS `id_actcreada`,
        `actividadesasignadas`.`nombre_act` AS `nombre_act`,
        `actividadesasignadas`.`tipo_act` AS `tipo_act`,
        `actividadesasignadas`.`descripcion` AS `descripcion`,
        `actividadesasignadas`.`objetivo` AS `objetivo`,
        `actividadesasignadas`.`fecha` AS `fecha`,
        `actividadesasignadas`.`status` AS `status`
        FROM (`actividadesasignadas` join `users` on((`actividadesasignadas`.`id_prestador` = `users`.`id`)))
        WHERE (`actividadesasignadas`.`status` = 'terminado');
       ");
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
