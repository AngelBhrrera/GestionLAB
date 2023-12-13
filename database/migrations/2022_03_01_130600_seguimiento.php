<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Seguimiento extends Migration
{

    public function up()
    {
        DB::statement("
        CREATE VIEW detalles_proyecto AS 
            SELECT p.titulo, a.nombre, p.status, u.name AS 'prestador asignado' , fecha AS 'fecha_comienzo', Tiempo_Invertido
            FROM actividades_prestadores
            INNER JOIN actividades AS a ON id_actividad = a.id
            INNER JOIN users AS u ON id_prestador = u.id
            INNER JOIN proyectos AS p ON id_proyecto = p.id;
        ");

        DB::statement("
        CREATE VIEW seguimiento_actividades AS 
            SELECT  
                u.name AS prestador, u.id AS id_prestador, a.nombre AS actividad, d.nombre AS categoria, p.titulo AS proyecto_origen, Tiempo_Real AS duracion, fecha, detalles,
                CASE 
                    WHEN Tiempo_Real <= (CASE WHEN a.TEC > TEU THEN TEU ELSE a.TEC END) THEN 10
                    WHEN Tiempo_Real <= (a.TEC + TEU) THEN 8
                    WHEN Tiempo_Real <= (CASE WHEN a.TEC < TEU THEN TEU ELSE a.TEC END) THEN 5
                    WHEN Tiempo_Real <= ((a.TEC + TEU) * 2) THEN 3
                    ELSE -3
                END AS exp_obtenida
            FROM actividades_prestadores 
            INNER JOIN actividades AS a ON id_actividad = a.id
            INNER JOIN users AS u ON id_prestador = u.id
            INNER JOIN categorias AS d ON a.id_categoria = d.id
            INNER JOIN proyectos AS p ON id_proyecto = p.id;
        ");

        DB::statement("
        CREATE VIEW seguimiento_proyecto AS 
            SELECT p.`titulo`, p.`status`, p.`id_encargado`, p.`fecha_inicio`, 
            COALESCE(SUM(ap.Tiempo_Invertido), 0) AS duracion, 
            ( SELECT COUNT(*) FROM actividades_prestadores ot WHERE ot.id_proyecto = p.id ) AS conteo_total, 
            ( SELECT COUNT(*) FROM actividades_prestadores ot WHERE ot.id_proyecto = p.id AND ot.Tiempo_Invertido = ot.Tiempo_Real ) AS conteo_terminado 
            FROM `proyectos` p 
            LEFT JOIN `actividades_prestadores` ap ON p.id = ap.id_proyecto 
            GROUP BY p.id; 
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW detalles_proyecto");
        DB::statement("DROP VIEW seguimiento_actividades");
        DB::statement("DROP VIEW seguimiento_proyecto");
    }
}
