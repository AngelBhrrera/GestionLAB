<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 250);
            $table->string('estado', 150)->default("Creado");
            $table->timestamp('fecha_inicio')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('fecha_final')->nullable()->default(null);
            $table->boolean('particular')->default(1);
            $table->integer('id_area');
            $table->integer('id_cliente')->nullable()->default(null);
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos');
    }
}
