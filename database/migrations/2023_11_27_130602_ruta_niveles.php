<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RutaNiveles extends Migration
{

    public function up()
    {
        DB::statement("
        CREATE VIEW ruta_niveles AS
        SELECT n.`nivel`, n.`experiencia` as exp, m.`ruta` 
        FROM `niveles` as n INNER JOIN `medallas` as m ON n.`nivel` = m.`nivel`; 
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW ruta_niveles");
    }
}
