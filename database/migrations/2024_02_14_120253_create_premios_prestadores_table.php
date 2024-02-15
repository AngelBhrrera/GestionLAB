<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePremiosPrestadoresTable extends Migration
{

    public function up()
    {
        Schema::create('premios_prestadores', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_prestador');
            $table->unsignedInteger('id_premio');
            $table->timestamp('fecha')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::statement("
            CREATE view total_horas_extra AS
                SELECT u.id, u.name, SUM(p.horas) AS horas
                FROM users AS u
                INNER JOIN premios_prestadores AS pp ON u.id = pp.id_prestador
                INNER JOIN premios AS p ON p.id = pp.id_premio
                WHERE p.tipo = 'horas'
                GROUP BY u.id
        ");

        DB::statement("
            CREATE VIEW seguimiento_horas_completo AS
                SELECT u.id, u.name, (the.horas+ch.horas_servicio) AS horas_servicio, (ch.horas_restantes-the.horas) as horas_restantes 
                FROM users AS u 
                INNER JOIN cuenta_horas AS ch ON ch.id = u.id 
                INNER JOIN total_horas_extra AS the ON the.id = u.id 
                GROUP BY u.id 
        ");
    }

    public function down()
    {
        Schema::dropIfExists('premios_prestadores');
        DB::statement("DROP VIEW total_horas_extra");
        DB::statement("DROP VIEW seguimiento_horas_completo");
    }
}
