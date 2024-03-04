<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{

    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {

            $table->id();
            $table->string('titulo', 255)->unique();
            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')->references('id')->on('categorias')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('id_subcategoria')->nullable();
            $table->integer('TEC')->nullable();
            $table->integer('exp_ref')->default('10');
            $table->integer('tipo')->default(0);
            $table->string('recursos', 500);
            $table->string('descripcion', 500);
            $table->string('objetivos', 500);
            
        });

        DB::table('actividades')->insert([
            "titulo" =>"Impresion 3D Laboratorio",
            "id_categoria" => 6,
            "id_subcategoria" => null,
            "TEC" => 20,
            "exp_ref" => 5,
            "tipo" => 1,
            "recursos" => "A,B,C,D",
            "descripcion" => "ejemplo",
            "objetivos"=> "1,2,3,4",
        ]);
        DB::table('actividades')->insert([
            "titulo" =>"Mantenimiento Impresora 3D Laboratorio",
            "id_categoria" => 3,
            "id_subcategoria" => null,
            "TEC" => 90,
            "exp_ref" => 10,
            "tipo" => 1,
            "recursos" => "A,B,C,D",
            "descripcion" => "ejemplo",
            "objetivos"=> "1,2,3,4",
        ]);

    }


    public function down()
    {
        Schema::dropIfExists('actividades');
    }
}
