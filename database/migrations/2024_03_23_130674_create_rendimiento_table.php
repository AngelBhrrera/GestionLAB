<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class rendimiento_coordinadores extends Migration
{

    public function up()
    {

        Schema::create('rendimiento', function (Blueprint $table) {
            
            $table->id();
           
            $table->integer('total_exp',0,0);
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_area');
            $table->string('turno', 50);
            $table->integer('semana',2,0);
            $table->integer('anio',2,0);
            $table->foreign('id_usuario')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('id_area')->references('id')->on('areas')->onUpdate('cascade');
            $table->timestamp('fecha_reporte')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }


    public function down()
    {
        Schema::dropIfExists('rendimiento');
    }
}
