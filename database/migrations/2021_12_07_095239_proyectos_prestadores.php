<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('id_prestador',0,0)->nullable();
            $table->integer('id_proyecto',0,0)->nullable();
            $table->string('status',400)->default('en proceso');
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
