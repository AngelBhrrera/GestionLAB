<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Carreras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreras', function (Blueprint $table) {
            $table->string('carrera', 100);
        });
        DB::table('carreras')->insert([
            "carrera" => "Otro"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieri­a Biomedica"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieria Civil"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieria en Alimentos y Biotecnologia"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieri­a en Computacion"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieria en Comunicaciones y Electronica"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieria en Informatica"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieria en Informatica"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieri­a en Logistica y Transporte"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieri­a en Topografia Geomatica"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieria Fotonica"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieria Industrial"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieri­a Mecanica Electrica"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Ingenieri­a Quimica"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Licenciatura en Ciencia de Materiales"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Licenciatura en Fisica"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Licenciatura en Matematicas"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Licenciatura en Quimica"
        ]);
        DB::table('carreras')->insert([
            "carrera"=>"Licenciatura en Quimico Farmaceutico Biologo"
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carreras');
    }
}
