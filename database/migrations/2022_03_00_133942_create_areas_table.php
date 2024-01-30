<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{

    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_area', 255);
        });

        DB::table('areas')->insert([
            ['nombre_area' => 'Modelado 3D'],
            ['nombre_area' => 'Informatica'],
            ['nombre_area' => 'Biomedica'],
            ['nombre_area' => 'Analisis de Datos'],
            ['nombre_area' => 'Experiencias interactivas'],
            ['nombre_area' => 'Organizacion'],
        ]);
    }


    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
