<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class sedeFilter extends Migration
{

    public function up()
    {
        DB::statement("
        CREATE VIEW filtroSedes AS
            SELECT 
                S.id_sede,
                S.nombre_sede,
                A.id AS id_area,
                A.nombre_area,
                A.turnoMatutino,
                A.turnoMediodia,
                A.turnoVespertino,
                A.turnoSabatino,
                A.turnoTiempoCompleto
        FROM `areas` AS A
            INNER JOIN `sedes` AS S ON A.id_sede = S.id_sede
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW filtroSedes");
    }
}
