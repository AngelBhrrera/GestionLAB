<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNivelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niveles', function (Blueprint $table) {

            $table->bigIncrements('nivel');
            $table->integer('experiencia');
            $table->integer('experiencia_acumulada');
            $table->string('nombre_insignia')->nullable()->default(null);
        });

        DB::statement("INSERT INTO `niveles` (`nivel`, `experiencia`, `experiencia_acumulada`, `nombre_insignia`) VALUES
        (1, 1, 1, 'Pollito'),
        (2, 178, 51, 'Maso de madera'),
        (3, 276, 80, 'Doble maso de madera'),
        (4, 388, 110, 'Maso de piedra'),
        (5, 509, 150, 'Doble maso de piedra'),
        (6, 633, 210, 'Hacha simple'),
        (7, 760, 290, 'Doble hacha simple'),
        (8, 891, 400, 'Hacha plateada'),
        (9, 1025, 460, 'Doble hacha plateada'),
        (10, 1142, 520, 'Hacha dorada'),
        (11, 1303, 590, 'Doble hacha dorada'),
        (12, 1420, 660, 'Hachón simple'),
        (13, 1523, 740, 'Hachón simple con gema púrpura'),
        (14, 1670, 820, 'Hachón plateado'),
        (15, 1725, 910, 'Hachón plateado con gema azul'),
        (16, 1890, 1000, 'Hachón dorado'),
        (17, 1994, 1115, 'Hachón dorado con gema roja'),
        (18, 2095, 1225, 'Cetro de Amatista'),
        (19, 2192, 1335, 'Cetro de Zafiro'),
        (20, 2286, 1445, 'Cetro de Rubí'),
        (21, 2336, 1555, 'Cetro de Diamante'),
        (22, 2386, 1685, 'Dragón Azul'),
        (23, 2436, 1840, 'Dragón Rojo'),
        (24, 2486, 2000, 'Dragón Plateado');");
    }

    public function down()
        {
            Schema::dropIfExists('niveles');
        }

}


