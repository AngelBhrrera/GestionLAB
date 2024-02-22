<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class sedesAreas extends Migration
{

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
                users u ON a.id = u.area AND u.tipo IN ('prestador', 'practicante', 'voluntario', 'coordinador') 
            GROUP BY 
                a.id;
        ");

    }

    public function down()
    {
        DB::statement("DROP VIEW sedes_areas");
    }
}
