<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class leaderboardWeek extends Migration
{

    public function up()
    {
        DB::statement("
            CREATE VIEW lb_w AS
            SELECT 
                solo_prestadores.id AS id_prestador,
                solo_prestadores.id_area,
                solo_prestadores.id_sede,
                COALESCE(SUM(CASE WHEN YEARWEEK(actividades_prestadores.fecha, 0) = YEARWEEK(NOW(), 0) THEN actividades_prestadores.exp ELSE 0 END), 0) AS total_exp
            FROM 
                solo_prestadores
            LEFT JOIN 
                actividades_prestadores ON actividades_prestadores.id_prestador =solo_prestadores.id
            GROUP BY 
                solo_prestadores.id;
        ");

        DB::statement("
        CREATE VIEW full_leaderboard_week AS
            SELECT sp.*, lb_w.total_exp 
            FROM solo_prestadores sp 
            INNER JOIN lb_w ON sp.id = lb_w.id_prestador
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
        DB::statement("DROP VIEW full_leaderboard_week");
    }
}
