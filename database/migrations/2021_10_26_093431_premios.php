<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Premios extends Migration
{

    public function up()
    {
        Schema::create('premios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->string('descripcion',255)->nullable();
            $table->string('tipo',50);
            $table->integer('horas',0,0)->nullable()->unsigned();
            $table->boolean('Visibilidad');
            $table->date('inicioVigencia');
            $table->date('finVigencia');
            $table->integer('limite');
            $table->id('id_actividad');
        });
    }

    public function down()
    {
        Schema::dropIfExists('premios');
    }
}
