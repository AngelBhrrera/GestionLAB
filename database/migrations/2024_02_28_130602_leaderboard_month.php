<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class leaderboardMonth extends Migration
{

    public function up()
    {
        DB::statement("
        CREATE VIEW lb_m AS
            SELECT 
                solo_prestadores.id AS id_prestador,
                solo_prestadores.id_area,
                solo_prestadores.id_sede,
                COALESCE(SUM(ap.exp), 0) AS total_exp
            FROM 
                solo_prestadores
            LEFT JOIN 
                (SELECT 
                    id_prestador,
                    exp
                FROM 
                    actividades_prestadores
                WHERE 
                    YEAR(fecha) = YEAR(NOW()) 
                    AND MONTH(fecha) = MONTH(NOW())) AS ap ON solo_prestadores.id = ap.id_prestador
            GROUP BY 
                solo_prestadores.id, solo_prestadores.id_area, solo_prestadores.id_sede;
        ");

        DB::statement("
        CREATE VIEW full_leaderboard_month AS
            SELECT sp.*, lb_m.total_exp 
            FROM solo_prestadores sp 
            INNER JOIN lb_m ON sp.id = lb_m.id_prestador
        ");

    }

    /**
     * Reverse the migrations.
     *
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW lb_w");
        DB::statement("DROP VIEW full_leaderboard_month");
    }
}
