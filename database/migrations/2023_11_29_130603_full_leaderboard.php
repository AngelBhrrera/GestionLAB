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
                SELECT users.id, MAX(ruta_niveles.nivel) AS max_nivel
                FROM users
                INNER JOIN ruta_niveles ON users.experiencia >= exp
                GROUP BY users.id
            ) AS max_nivel ON users.id = max_nivel.id
            INNER JOIN ruta_niveles ON max_nivel.max_nivel = ruta_niveles.nivel
            INNER JOIN leaderboard ON leaderboard.codigo = users.codigo
        ");

        DB::statement("
        CREATE VIEW full_leaderboard_w AS
            SELECT 
                leaderboard_week.Posicion, leaderboard_week.Inventor,  
                COALESCE(leaderboard_week.experiencia, 0) AS experiencia, 
                ruta_niveles.ruta, max_nivel.max_nivel, leaderboard_week.codigo        
            FROM users 
            INNER JOIN (
                SELECT users.id, MAX(ruta_niveles.nivel) AS max_nivel
                FROM users
                INNER JOIN ruta_niveles ON users.experiencia >= exp
                GROUP BY users.id
            ) AS max_nivel ON users.id = max_nivel.id
            INNER JOIN ruta_niveles ON max_nivel.max_nivel = ruta_niveles.nivel
            INNER JOIN leaderboard_week ON leaderboard_week.codigo = users.codigo
            ORDER BY leaderboard_week.Posicion ASC;
        ");

        DB::statement("
        CREATE VIEW full_leaderboard_m AS
        SELECT 
                leaderboard_month.Posicion, 
                leaderboard_month.Inventor, 
                COALESCE(leaderboard_month.experiencia, 0) AS experiencia,
                ruta_niveles.ruta, 
                max_nivel.max_nivel, 
                leaderboard_month.codigo    
            FROM 
                users 
            INNER JOIN (
                SELECT 
                    users.id, 
                    MAX(ruta_niveles.nivel) AS max_nivel
                FROM 
                    users
                INNER JOIN 
                    ruta_niveles ON users.experiencia >= exp
                GROUP BY 
                    users.id
            ) AS max_nivel ON users.id = max_nivel.id
            INNER JOIN 
                ruta_niveles ON max_nivel.max_nivel = ruta_niveles.nivel
            INNER JOIN 
                leaderboard_month ON leaderboard_month.codigo = users.codigo
        ORDER BY leaderboard_month.Posicion ASC;
        ");

    }

    public function down()
    {
        DB::statement("DROP VIEW full_leaderboard");
        DB::statement("DROP VIEW full_leaderboard_w");
        DB::statement("DROP VIEW full_leaderboard_m");
    }
}
