<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{

    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {

            $table->id();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('cascade');
            $table->string('nombre', 255)->collation('utf8mb4_unicode_ci');
            $table->string('descripcion', 500)->collation('utf8mb4_unicode_ci');
           

            /*
            $table->string('status', 50)->collation('utf8mb4_unicode_ci');
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
            $table->foreign('prestador_id')->references('id')->on('user');
            $table->string('fecha_inicio', 100)->nullable();
            $table->string('fecha_termino', 100)->nullable();
            $table->time('tiempo_acumulado');*/

            
        });

    }


    public function down()
    {
        Schema::dropIfExists('actividades');
    }
}
