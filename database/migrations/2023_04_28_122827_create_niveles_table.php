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
        (1, 1, 19, 'Pollito'),
        (2, 20, 59, 'Maso de madera'),
        (3, 60, 79, 'Doble maso de madera'),
        (4, 80, 109, 'Maso de piedra'),
        (5, 110, 149, 'Doble maso de piedra'),
        (6, 150, 209, 'Hacha simple'),
        (7, 210, 289, 'Doble hacha simple'),
        (8, 290, 399, 'Hacha plateada'),
        (9, 400, 459, 'Doble hacha plateada'),
        (10, 460, 519, 'Hacha dorada'),
        (11, 520, 589, 'Doble hacha dorada'),
        (12, 590, 659, 'Hachón simple'),
        (13, 660, 739, 'Hachón simple con gema púrpura'),
        (14, 740, 819, 'Hachón plateado'),
        (15, 820, 909, 'Hachón plateado con gema azul'),
        (16, 910, 999, 'Hachón dorado'),
        (17, 1000, 1114, 'Hachón dorado con gema roja'),
        (18, 1115, 1224, 'Cetro de Amatista'),
        (19, 1225, 1334, 'Cetro de Zafiro'),
        (20, 1335, 1444, 'Cetro de Rubí'),
        (21, 1445, 1554, 'Cetro de Diamante'),
        (22, 1555, 1684, 'Dragón Azul'),
        (23, 1685, 1839, 'Dragón Rojo'),
        (24, 2000, 2000, 'Dragón Plateado');");
    }

    public function down()
        {
            Schema::dropIfExists('niveles');
        }

}


