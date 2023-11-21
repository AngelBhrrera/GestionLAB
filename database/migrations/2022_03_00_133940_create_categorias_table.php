<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255)->collation('utf8mb4_unicode_ci');
            $table->timestamps();
        });

        DB::table('categorias')->insert([
            "nombre" => "Administracion",
            "nombre" => "Desarrollo de videojuegos",
            "nombre" => "Diseño",
            "nombre" => "Drones",
            "nombre" => "Impresion 3D",
            "nombre" => "Modelado 3D",
            "nombre" => "Mantenimiento",
            "nombre" => "Programacion",
            "nombre" => "Sistema Web",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
