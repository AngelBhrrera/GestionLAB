<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ProyectosPrestadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos_prestadores', function (Blueprint $table) {

            $table->id('id');
            $table->unsignedBigInteger('id_proyecto');
            $table->unsignedBigInteger('id_prestador');
            $table->foreign('id_proyecto')->references('id')->on('proyectos')->onUpdate('cascade');
            $table->foreign('id_prestador')->references('id')->on('users')->onUpdate('cascade');
            $table->string('status',400)->default('Creado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proyectos_prestadores');
    }
}
