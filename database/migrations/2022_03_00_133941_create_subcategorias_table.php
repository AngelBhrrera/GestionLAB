<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSubcategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255);
            $table->unsignedBigInteger('categoria');
        });

        DB::statement("INSERT INTO `subcategorias` (`nombre`, `categoria`) VALUES 
             ('Web', 1) , ('Bases de datos', 1), ('Movil', 1), ('Servidores', 1), ('Software', 1),
            ('Inventario', 2), ('Preventivo', 3), ('Correctivo', 3), ('Videojuegos', 8), ('Drones', 9),
            ('RV', 8) ");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subcategorias');
    }
}
