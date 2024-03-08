<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class prestadorData extends Migration
{

    public function up()
    {
        DB::statement("
        CREATE VIEW semanas_prestador AS
            SELECT 
                idusuario,
                CEIL(DATEDIFF(NOW(), MIN(STR_TO_DATE(fecha, '%d/%m/%Y'))) / 7) AS semanas_actividad
            FROM 
                registros_checkin
            GROUP BY 
                idusuario;
        ");

        DB::statement("
        CREATE VIEW user_level AS
            SELECT ruta_niveles.ruta, max_nivel.max_nivel, u.id
            FROM users u
            INNER JOIN (
                SELECT u.id, MAX(rn.nivel) AS max_nivel
                FROM users u
                INNER JOIN ruta_niveles rn ON u.experiencia >= rn.exp
                GROUP BY u.id
            ) AS max_nivel ON u.id = max_nivel.id
            INNER JOIN ruta_niveles ON max_nivel.max_nivel = ruta_niveles.nivel;
        ");
    }

    public function down()
    {
        DB::statement("DROP VIEW semanas_prestador");
        DB::statement("DROP VIEW user_level");
       
    }
}
