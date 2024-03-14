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
                GROUP BY u.id, u.name, p.horas;
        ");

        DB::statement("
            CREATE VIEW seguimiento_horas_completo AS
                SELECT 
                    u.id, 
                    u.name, 
                    (COALESCE(the.horas, 0) + COALESCE(ch.horas_servicio, 0)) AS horas_servicio, 
                    (COALESCE(ch.horas_restantes, 0) - COALESCE(the.horas, 0)) AS horas_restantes 
                FROM 
                    cuenta_horas AS ch 
                LEFT JOIN 
                    users AS u ON ch.id = u.id 
                LEFT JOIN 
                    total_horas_extra AS the ON the.id = u.id;
        ");

        DB::statement("
        CREATE VIEW seguimiento_premios AS
            SELECT CONCAT(u.name, ' ', u.apellido) AS nombre_prestador, 
                premios_prestadores.id_premio,
                p.nombre, 
                p.descripcion, 
                p.tipo, 
                p.horas, 
                premios_prestadores.id,
                premios_prestadores.fecha
            FROM premios_prestadores
            INNER JOIN users u ON u.id = premios_prestadores.id_prestador
            INNER JOIN premios p ON p.id = premios_prestadores.id_premio
            GROUP BY premios_prestadores.id, u.name, u.apellido,
            p.nombre, p.descripcion, p.tipo, p.horas, premios_prestadores.fecha
        ");    
    }


    public function down()
    {
        Schema::dropIfExists('premios_prestadores');
        DB::statement("DROP VIEW total_horas_extra");
        DB::statement("DROP VIEW seguimiento_horas_completo");
        DB::statement("DROP VIEW seguimiento_premios");
    }
}
