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
                S.id_Sede,
                S.nombre_Sede AS sede_nombre,
                A.id AS area_id,
                A.nombre_area AS area_nombre,
                S.turnoMatutino,
                S.turnoMediodia,
                S.turnoVespertino,
                S.turnoSabatino,
                S.turnoTiempoCompleto
            FROM `sedes_areas` AS SA
            INNER JOIN `sedes` AS S ON SA.id_sede = S.id_Sede
            INNER JOIN `areas` AS A ON SA.id_area = A.id;
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
