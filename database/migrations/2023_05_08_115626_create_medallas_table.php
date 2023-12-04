<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedallasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medallas', function (Blueprint $table) {
            $table->bigIncrements('nivel');
            $table->string('ruta');
            $table->string('descripcion');
            $table->foreign('nivel')->references('nivel')->on('niveles');
        });

        DB::statement("INSERT INTO `medallas` (`nivel`, `ruta`, `descripcion`) VALUES
        (1, 'img/Medallas/Pollito.gif', 'Pollito'),
        (2, 'img/Medallas/maso-de-madera.gif', 'Maso de madera'),
        (3, 'img/Medallas/Doble maso de madera.gif', 'Doble maso de madera'),
        (4, 'img/Medallas/maso-de-piedra.gif', 'Maso de piedra'),
        (5, 'img/Medallas/doble-maso-de-piedra.gif', 'Doble maso de piedra'),
        (6, 'img/Medallas/hacha_simple.gif', 'Hacha simple'),
        (7, 'img/Medallas/Doble-hacha-simple.gif', 'Doble hacha simple'),
        (8, 'img/Medallas/Hacha-plateada.gif', 'Hacha plateada'),
        (9, 'img/Medallas/Doble-hacha-plateada.gif', 'Doble hacha plateada'),
        (10, 'img/Medallas/Hacha-dorada.gif', 'Hacha dorada'),
        (11, 'img/Medallas/Doble-hacha-dorada.gif', 'Doble hacha dorada'),
        (12, 'img/Medallas/Hachón-simple.gif', 'Hachón simple'),
        (13, 'img/Medallas/Hachón-simple-con-gema-púrpura.gif', 'Hachón simple con gema púrpura'),
        (14, 'img/Medallas/Hachón-plateado.gif', 'Hachón plateado'),
        (15, 'img/Medallas/Hachón-plateado-con-gema-azul.gif', 'Hachón plateado con gema azul'),
        (16, 'img/Medallas/Hachón-dorado.gif', 'Hachón dorado'),
        (17, 'img/Medallas/Hachón-dorado-con-gema-roja.gif', 'Hachón dorado con gema roja'),
        (18, 'img/Medallas/Cetro-de-Amatista.gif', 'Cetro de Amatista'),
        (19, 'img/Medallas/Cetro-de-Zafiro.gif', 'Cetro de Zafiro'),
        (20, 'img/Medallas/Cetro-de-Rubí.gif', 'Cetro de Rubí'),
        (21, 'img/Medallas/Cetro-de-Diamante.gif', 'Cetro de Diamante'),
        (22, 'img/Medallas/Dragón-Azul.gif', 'Dragón Azul'),
        (23, 'img/Medallas/Dragón-Rojo.gif', 'Dragón Rojo'),
        (24, 'img/Medallas/Dragón-Plateado.gif', 'Dragón Plateado');");
        
    }

    public function down()
    {
        Schema::dropIfExists('medallas');
    }
}
