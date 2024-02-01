<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSedesVistasTable extends Migration
{

    public function up()
    {
        Schema::create('sedes_vistas', function (Blueprint $table) {
            
            $table->id();

            $table->boolean('torneo')->default(0);
            $table->boolean('impresiones')->default(0);
            $table->boolean('visitas')->default(0);
            $table->boolean('reportes')->default(0);
           
        });

        DB::table('sedes_vistas')->insert([
            ['id' => 0, 'torneo' => 1, 'impresiones' => 1, 'visitas' => 1, 'reportes' => 1],
            ['id' => 1, 'torneo' => 1, 'impresiones' => 1, 'visitas' => 1, 'reportes' => 0],
            ['id' => 2, 'torneo' => 0, 'impresiones' => 0, 'visitas' => 0, 'reportes' => 1],
            ['id' => 3, 'torneo' => 0, 'impresiones' => 0, 'visitas' => 1, 'reportes' => 1],
            ['id' => 4, 'torneo' => 1, 'impresiones' => 0, 'visitas' => 1, 'reportes' => 0],
            ['id' => 5, 'torneo' => 1, 'impresiones' => 0, 'visitas' => 1, 'reportes' => 0],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('sedes_visitas');
    }
}
