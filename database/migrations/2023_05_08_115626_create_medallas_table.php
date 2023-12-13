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
        (1, '/images/Medallas/Pollito.gif', 'Pollito'),
        (2, '/images/Medallas/maso-de-madera.gif', 'Maso de madera'),
        (3, '/images/Medallas/Doble maso de madera.gif', 'Doble maso de madera'),
        (4, '/images/Medallas/maso-de-piedra.gif', 'Maso de piedra'),
        (5, '/images/Medallas/doble-maso-de-piedra.gif', 'Doble maso de piedra'),
        (6, '/images/Medallas/hacha_simple.gif', 'Hacha simple'),
        (7, '/images/Medallas/Doble-hacha-simple.gif', 'Doble hacha simple'),
        (8, '/images/Medallas/Hacha-plateada.gif', 'Hacha plateada'),
        (9, '/images/Medallas/Doble-hacha-plateada.gif', 'Doble hacha plateada'),
        (10, '/images/Medallas/Hacha-dorada.gif', 'Hacha dorada'),
        (11, '/images/Medallas/Doble-hacha-dorada.gif', 'Doble hacha dorada'),
        (12, '/images/Medallas/Hachón-simple.gif', 'Hachón simple'),
        (13, '/images/Medallas/Hachón-simple-con-gema-púrpura.gif', 'Hachón simple con gema púrpura'),
        (14, '/images/Medallas/Hachón-plateado.gif', 'Hachón plateado'),
        (15, '/images/Medallas/Hachón-plateado-con-gema-azul.gif', 'Hachón plateado con gema azul'),
        (16, '/images/Medallas/Hachón-dorado.gif', 'Hachón dorado'),
        (17, '/images/Medallas/Hachón-dorado-con-gema-roja.gif', 'Hachón dorado con gema roja'),
        (18, '/images/Medallas/Cetro-de-Amatista.gif', 'Cetro de Amatista'),
        (19, '/images/Medallas/Cetro-de-Zafiro.gif', 'Cetro de Zafiro'),
        (20, '/images/Medallas/Cetro-de-Rubí.gif', 'Cetro de Rubí'),
        (21, '/images/Medallas/Cetro-de-Diamante.gif', 'Cetro de Diamante'),
        (22, '/images/Medallas/Dragón-Azul.gif', 'Dragón Azul'),
        (23, '/images/Medallas/Dragón-Rojo.gif', 'Dragón Rojo'),
        (24, '/images/Medallas/Dragón-Plateado.gif', 'Dragón Plateado');");
        
    }

    public function down()
    {
        Schema::dropIfExists('medallas');
    }
}
