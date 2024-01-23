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
            $table->string('ruta_n');
            $table->string('descripcion');
            $table->string('ruta');
            $table->foreign('nivel')->references('nivel')->on('niveles');
        });

        DB::statement("INSERT INTO `medallas` (`nivel`, `ruta`, `descripcion`, `ruta_n`) VALUES
        (1, '/images/Medallas/Pollito.ico', 'Pollito', '/images/niveles/lvl1.ico'),
        (2, '/images/Medallas/maso-de-madera.ico', 'Maso de madera', '/images/niveles/lvl2.ico'),
        (3, '/images/Medallas/Doble maso de madera.ico', 'Doble maso de madera', '/images/niveles/lvl3.ico'),
        (4, '/images/Medallas/maso-de-piedra.ico', 'Maso de piedra', '/images/niveles/lvl4.ico'),
        (5, '/images/Medallas/doble-maso-de-piedra.ico', 'Doble maso de piedra', '/images/niveles/lvl5.ico'),
        (6, '/images/Medallas/hacha-simple.ico', 'Hacha simple', '/images/niveles/lvl6.ico'),
        (7, '/images/Medallas/Doble-hacha-simple.ico', 'Doble hacha simple', '/images/niveles/lvl7.ico'),
        (8, '/images/Medallas/Hacha-plateada.ico', 'Hacha plateada', '/images/niveles/lvl8.ico'), 
        (9, '/images/Medallas/Doble-hacha-plateada.ico', 'Doble hacha plateada', '/images/niveles/lvl9.ico'),
        (10, '/images/Medallas/Hacha-dorada.ico', 'Hacha dorada', '/images/niveles/lvl10.ico'),
        (11, '/images/Medallas/Doble-hacha-dorada.ico', 'Doble hacha dorada', '/images/niveles/lvl11.ico'),
        (12, '/images/Medallas/Hachón-simple.ico', 'Hachón simple', '/images/niveles/lvl12.ico'),
        (13, '/images/Medallas/Hachón-simple-con-gema-púrpura.ico', 'Hachón simple con gema púrpura', '/images/niveles/lvl13.ico'),
        (14, '/images/Medallas/Hachón-plateado.ico', 'Hachón plateado', '/images/niveles/lvl4.ico'),
        (15, '/images/Medallas/Hachón-plateado-con-gema-azul.ico', 'Hachón plateado con gema azul', '/images/niveles/lvl5.ico'),
        (16, '/images/Medallas/Hachón-dorado.ico', 'Hachón dorado', '/images/niveles/lvl16.ico'),
        (17, '/images/Medallas/Hachón-dorado-con-gema-roja.ico', 'Hachón dorado con gema roja', '/images/niveles/lvl7.ico'),
        (18, '/images/Medallas/Cetro-de-Amatista.ico', 'Cetro de Amatista', '/images/niveles/lvl18.ico'),
        (19, '/images/Medallas/Cetro-de-Zafiro.ico', 'Cetro de Zafiro', '/images/niveles/lvl19.ico'),
        (20, '/images/Medallas/Cetro-de-Rubí.ico', 'Cetro de Rubí', '/images/niveles/lvl20.ico'),
        (21, '/images/Medallas/Cetro-de-Diamante.ico', 'Cetro de Diamante', '/images/niveles/lvl21.ico'),
        (22, '/images/Medallas/Dragón-Azul.ico', 'Dragón Azul', '/images/niveles/lvl22.ico'),
        (23, '/images/Medallas/Dragón-Rojo.ico', 'Dragón Rojo', '/images/niveles/lvl23.ico'),
        (24, '/images/Medallas/Dragón-Plateado.ico', 'Dragón Plateado', '/images/niveles/lvl24.ico');");
    }

    public function down()
    {
        Schema::dropIfExists('medallas');
    }
}
