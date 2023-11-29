<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PrestadoresServicioConcluido extends Migration
{

    public function up()
    {
        DB::statement("

        CREATE VIEW `leaderboard` AS 
            SELECT
                ROW_NUMBER() OVER (ORDER BY `users`.`experiencia` DESC) AS Posicion,
                CONCAT(`users`.`name`, ' ', `users`.`apellido`) AS Inventor,
                `users`.`experiencia` AS Experiencia
            FROM `users`
        ORDER BY `users`.`experiencia` DESC LIMIT 20
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW leaderboard");
    }
}
