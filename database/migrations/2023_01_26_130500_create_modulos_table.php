<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateModulosTable extends Migration
{

    public function up()
    {
        Schema::create('modulos', function (Blueprint $table) {
            
            $table->id();

            $table->boolean('gamificacion')->default(0);
            $table->boolean('impresiones')->default(0);
            $table->boolean('visitas')->default(0);
            $table->boolean('solicitudes')->default(0);
           
        });

        DB::table('modulos')->insert([
            ['id' => 1, 'gamificacion' => 1, 'impresiones' => 1, 'visitas' => 1, 'solicitudes' => 1],
            ['id' => 2, 'gamificacion' => 0, 'impresiones' => 0, 'visitas' => 0, 'solicitudes' => 1],
            ['id' => 3, 'gamificacion' => 0, 'impresiones' => 0, 'visitas' => 1, 'solicitudes' => 1],
            ['id' => 4, 'gamificacion' => 1, 'impresiones' => 0, 'visitas' => 1, 'solicitudes' => 1],
            ['id' => 5,'gamificacion' => 1, 'impresiones' => 1, 'visitas' => 1, 'solicitudes' => 1],
        ]);

        DB::statement('UPDATE modulos SET id = 0 WHERE id = 5;');
    }

    public function down()
    {
        Schema::dropIfExists('modulos');
    }
}
