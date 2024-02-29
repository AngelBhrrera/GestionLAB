<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class leaderboard extends Migration
{

    public function up()
    {
        DB::statement("
        CREATE VIEW lb_at AS
        SELECT 
            `users`.`id` AS id_prestador, 
            `users`.`experiencia` AS total_exp, 
            `solo_prestadores`.`id_sede` AS id_sede, 
            `solo_prestadores`.`id_area` AS id_area 
        FROM 
            `solo_prestadores` 
        INNER JOIN 
            `users` ON `users`.`id` = `solo_prestadores`.`id`;
        
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW lb_at");
    }
}
