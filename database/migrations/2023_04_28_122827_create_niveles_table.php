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
        (2, 178, 241, 'Maso de madera'),
        (3, 276, 481, 'Doble maso de madera'),
        (4, 388, 721, 'Maso de piedra'),
        (5, 509, 961, 'Doble maso de piedra'),
        (6, 633, 1201, 'Hacha simple'),
        (7, 760, 1441, 'Doble hacha simple'),
        (8, 891, 1681, 'Hacha plateada'),
        (9, 1025, 1921, 'Doble hacha plateada'),
        (10, 1142, 2161, 'Hacha dorada'),
        (11, 1303, 2401, 'Doble hacha dorada'),
        (12, 1420, 2641, 'Hachón simple'),
        (13, 1523, 2881, 'Hachón simple con gema púrpura'),
        (14, 1670, 3121, 'Hachón plateado'),
        (15, 1725, 3361, 'Hachón plateado con gema azul'),
        (16, 1890, 3601, 'Hachón dorado'),
        (17, 1994, 3841, 'Hachón dorado con gema roja'),
        (18, 2095, 4081, 'Cetro de Amatista'),
        (19, 2192, 4321, 'Cetro de Zafiro'),
        (20, 2286, 4561, 'Cetro de Rubí'),
        (21, 2336, 4801, 'Cetro de Diamante'),
        (22, 2386, 5041, 'Dragón Azul'),
        (23, 2436, 5281, 'Dragón Rojo'),
        (24, 2486, 5521, 'Dragón Plateado');");
    }

    public function down()
        {
            Schema::dropIfExists('niveles');
        }

}


