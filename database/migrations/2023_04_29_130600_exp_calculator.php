<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class expCalculator extends Migration
{

    public function up()
    {
        DB::statement("
        CREATE VIEW exp_calculator AS 
            SELECT  
                actividades_prestadores.id, u.name AS prestador, a.titulo AS actividad, d.nombre AS categoria,
                CASE 
                    WHEN a.TEC > TEU THEN  TEU
                    ELSE a.TEC
                END AS minor_t,
                (a.TEC + TEU)/2 AS TC,
                CASE 
                    WHEN a.TEC > TEU THEN  a.TEC
                    ELSE TEU
                END AS MAJOR_T,
                a.TEC + TEU AS TT,
                Tiempo_Real, 
                CASE 
                WHEN Tiempo_Real <= (CASE WHEN a.TEC > TEU THEN TEU ELSE a.TEC END) THEN ROUND((a.exp_ref))
                WHEN Tiempo_Real <= (a.TEC + TEU)/2 THEN ROUND((a.exp_ref * 0.8))
                WHEN Tiempo_Real <= (CASE WHEN a.TEC < TEU THEN TEU ELSE a.TEC END) THEN ROUND((a.exp_ref * 0.5))
                WHEN Tiempo_Real <= (a.TEC + TEU) THEN ROUND((a.exp_ref * 0.3))
                ELSE ROUND((a.exp_ref * -0.3))
                END AS exp_obtenida
            FROM actividades_prestadores 
            INNER JOIN actividades AS a ON id_actividad = a.id
            INNER JOIN users AS u ON id_prestador = u.id
            INNER JOIN categorias AS d ON a.id_categoria = d.id
            WHERE Tiempo_Invertido = Tiempo_Real; 
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW exp_calculator");
    }
}
