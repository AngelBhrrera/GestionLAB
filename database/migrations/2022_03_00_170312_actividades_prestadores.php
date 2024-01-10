<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class ActividadesPrestadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_prestadores', function (Blueprint $table) {

            $table->id('id');
            $table->unsignedBigInteger('id_proyecto');
            $table->unsignedBigInteger('id_prestador');
            $table->unsignedBigInteger('id_actividad');
            $table->foreign('id_proyecto')->references('id')->on('proyectos')->onUpdate('cascade');
            $table->foreign('id_prestador')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('id_actividad')->references('id')->on('actividades')->onUpdate('cascade');
            $table->timestamp('fecha')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('TEU');
            $table->integer('Tiempo_Invertido');
            $table->integer('Tiempo_Real');
            $table->integer('exp');
            $table->string('detalles', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_prestadores');
    }
}
