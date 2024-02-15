<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class Seguimiento extends Migration
{

    public function up()
    {
        DB::statement("
        CREATE VIEW detalles_proyecto AS 
            SELECT p.`id`, p.`titulo` AS 'Proyecto', a.titulo, p.estado, u.name AS 'prestador asignado' , fecha AS 'fecha_comienzo', Tiempo_Invertido
            FROM actividades_prestadores
            INNER JOIN actividades AS a ON id_actividad = a.id
            INNER JOIN users AS u ON id_prestador = u.id
            INNER JOIN proyectos AS p ON id_proyecto = p.id;
        ");

        DB::statement("
        CREATE VIEW seguimiento_actividades AS 
            SELECT  
                u.name + ' ' + u.apellido AS prestador, u.id AS id_prestador, a.id AS actividad_id, a.titulo AS actividad, d.nombre AS categoria, p.id AS id_proyecto, p.titulo AS proyecto_origen, Tiempo_Real AS duracion, fecha, detalles,
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
            SELECT proyectos.id, proyectos.titulo, proyectos.estado, proyectos.fecha_inicio, proyectos.fecha_final,
            COALESCE(pp.n_prestadores, 0) as n_prestadores,
            COALESCE(ap.n_acts, 0) as n_acts
            FROM proyectos
            LEFT JOIN (
                SELECT id_proyecto, count(*) as n_prestadores
                FROM proyectos_prestadores
                GROUP BY id_proyecto
            ) AS pp ON proyectos.id = pp.id_proyecto
            LEFT JOIN (
                SELECT id_proyecto, count(*) as n_acts
                FROM actividades_prestadores
                GROUP BY id_proyecto
            ) AS ap ON proyectos.id = ap.id_proyecto
            ORDER BY proyectos.id;
        ");

        DB::statement("
        CREATE VIEW seguimiento_proyecto2 AS 
            SELECT p.id,
            COALESCE(SUM(ap.Tiempo_Invertido), 0) AS duracion, 
            ( SELECT COUNT(*) FROM actividades_prestadores ot WHERE ot.id_proyecto = p.id AND ot.Tiempo_Invertido = ot.Tiempo_Real ) AS conteo_terminado 
            FROM proyectos p 
            LEFT JOIN actividades_prestadores ap ON p.id = ap.id_proyecto 
            GROUP BY p.id; 
        ");

        DB::statement("
        CREATE VIEW seguimiento_proyecto3 AS 
            SELECT sp.*, sp2.*
            FROM seguimiento_proyecto sp 
            INNER JOIN seguimiento_proyecto2 sp2 ON sp.id = sp2.id
        ");
    }

    public function down()
    {
        DB::statement("DROP VIEW detalles_proyecto");
        DB::statement("DROP VIEW seguimiento_actividades");
        DB::statement("DROP VIEW seguimiento_proyecto");
    }
}
