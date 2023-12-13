<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class fullLeaderboard extends Migration
{

    public function up()
    {
        DB::statement("

        CREATE VIEW full_leaderboard AS
            SELECT leaderboard.Posicion, leaderboard.Inventor, leaderboard.experiencia, ruta_niveles.ruta, max_nivel.max_nivel, leaderboard.codigo
            FROM users
            INNER JOIN (
                SELECT users.name, MAX(ruta_niveles.nivel) AS max_nivel
                FROM users
                INNER JOIN ruta_niveles ON users.experiencia >= exp
                GROUP BY users.name
            ) AS max_nivel ON users.name = max_nivel.name
            INNER JOIN ruta_niveles ON max_nivel.max_nivel = ruta_niveles.nivel
            INNER JOIN leaderboard ON leaderboard.codigo = users.codigo
        ");

        DB::statement("
        CREATE VIEW full_leaderboard_w AS
            SELECT leaderboard_week.Posicion, leaderboard_week.Inventor, leaderboard_week.experiencia, ruta_niveles.ruta, max_nivel.max_nivel, leaderboard_week.codigo        
            FROM users 
            INNER JOIN (
                SELECT users.name, MAX(ruta_niveles.nivel) AS max_nivel
                FROM users
                INNER JOIN ruta_niveles ON users.experiencia >= exp
                GROUP BY users.name
            ) AS max_nivel ON users.name = max_nivel.name
            INNER JOIN ruta_niveles ON max_nivel.max_nivel = ruta_niveles.nivel
            INNER JOIN leaderboard_week ON leaderboard_week.codigo = users.codigo;
        ");

        DB::statement("
        CREATE VIEW full_leaderboard_m AS
        SELECT 
            leaderboard_month.Posicion, 
            leaderboard_month.Inventor, 
            leaderboard_month.experiencia, 
            ruta_niveles.ruta, 
            max_nivel.max_nivel, 
            leaderboard_month.codigo    
        FROM 
            users 
        INNER JOIN (
            SELECT 
                users.name, 
                MAX(ruta_niveles.nivel) AS max_nivel
            FROM 
                users
            INNER JOIN 
                ruta_niveles ON users.experiencia >= exp
            GROUP BY 
                users.name
        ) AS max_nivel ON users.name = max_nivel.name
        INNER JOIN 
            ruta_niveles ON max_nivel.max_nivel = ruta_niveles.nivel
        INNER JOIN 
            leaderboard_month ON leaderboard_month.codigo = users.codigo;
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW full_leaderboard");
        DB::statement("DROP VIEW full_leaderboard_w");
        DB::statement("DROP VIEW full_leaderboard_m");
    }
}
