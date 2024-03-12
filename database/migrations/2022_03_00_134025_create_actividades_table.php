<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            "recursos" => "software de preparacion para impresion,computadora,memoria microsd,adaptador,impresora, filamento",
            "descripcion" => "Brindar el servicio de impresion de formas 3D mediante el uso de las impresoras del laboratorio",
            "objetivos"=> "brindar un servicio eficaz, no hacer gasto inadecuado del material, realizar la impresion tomando en cuenta el mantenimiento correspondiente a la impresora",
        ]);
        DB::table('actividades')->insert([
            "titulo" =>"Mantenimiento Impresora 3D Laboratorio",
            "id_categoria" => 3,
            "id_subcategoria" => null,
            "TEC" => 90,
            "exp_ref" => 10,
            "tipo" => 1,
            "recursos" => "herramientas de mantenimiento",
            "descripcion" => "Llevar a cabo de forma periodica una revision exhaustiva del estado actual del equipo utilizado en el Laboratorio para la elaboracion de impresiones 3D",
            "objetivos"=> "mantener un orden del uso que se le da a las impresiones, brindar un mantenimiento preventivo o correctivo en caso de necesitarse",
        ]);

    }


    public function down()
    {
        Schema::dropIfExists('actividades');
    }
}
