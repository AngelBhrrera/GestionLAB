<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class leaderboardWeek extends Migration
{

    public function up()
    {
        DB::statement("
            CREATE VIEW experiencia_semanal AS
            SELECT actividades_prestadores.id_prestador, SUM(exp) AS total_exp 
            FROM actividades_prestadores 
            WHERE YEARWEEK(actividades_prestadores.fecha) = YEARWEEK(NOW()) 
            GROUP BY actividades_prestadores.id_prestador; 
        ");

        DB::statement("
            CREATE VIEW leaderboard_week AS
            SELECT ROW_NUMBER() OVER (ORDER BY es.total_exp DESC) AS Posicion, 
            CONCAT(u.name, ' ', u.apellido) AS inventor, 
            u.codigo AS codigo, 
            es.total_exp AS experiencia FROM `users` u 
                INNER JOIN experiencia_semanal es ON es.id_prestador = u.id 
            ORDER BY es.total_exp DESC; 
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
        DB::statement("DROP VIEW experiencia_semanal");
        DB::statement("DROP VIEW leaderboard_week");
    }
}
