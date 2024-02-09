<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SedesAreas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        CREATE VIEW sedes_areas AS
        SELECT
            a.*,
            s.nombre_sede,
            COUNT(u.id) AS total_personal,
            m.gamificacion,
            m.impresiones,
            m.visitas,
            m.solicitudes
        FROM
            areas a
        JOIN
            sedes s ON a.id_sede = s.id_sede
        JOIN
            modulos m ON a.id = m.id
        LEFT JOIN
            users u ON a.id = u.area AND u.tipo IN ('prestador', 'practicante', 'voluntario', 'encargado')
        GROUP BY
            a.id, s.id_sede;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sedes_areas');
    }
}
