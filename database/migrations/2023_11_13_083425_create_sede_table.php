<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSedeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sede', function (Blueprint $table) {

            $table->id('id_Sede');
            $table->string('nombre_Sede', 150);
            $table->integer('turnoMatutino', 10);
            $table->integer('turnoMediodia', 10);
            $table->integer('turnoVespertino', 10);
            $table->integer('turnoSabatino', 10);
            $table->integer('turnoTiempoCompleto', 10);
            $table->integer('No Aplica', 10);

            DB::table('sede')->insert([
                "nombre_Sede" => "CUCEI Laboratorio",
                'turnoMatutino'=> 1,
                'turnoMediodia'=> 1,
                'turnoVespertino'=> 1,
                'turnoSabatino'=> 1,
                'turnoTiempoCompleto'=> 1,
                'turnoNoAplica'=> 1,
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CUCEI Coordinación",
                'turnoMatutino'=> 1,
                'turnoMediodia'=> 1,
                'turnoVespertino'=> 1,
                'turnoSabatino'=> 0,
                'turnoTiempoCompleto'=> 0,
                'turnoNoAplica'=> 1,
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CUCEI Innovación",
                'turnoMatutino'=> 1,
                'turnoMediodia'=> 1,
                'turnoVespertino'=> 1,
                'turnoSabatino'=> 1,
                'turnoTiempoCompleto'=> 1,
                'turnoNoAplica'=> 0,
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CFE",
                'turnoMatutino'=> 0,
                'turnoMediodia'=> 0,
                'turnoVespertino'=> 0,
                'turnoSabatino'=> 1,
                'turnoTiempoCompleto'=> 1,
                'turnoNoAplica'=> 1,
            ]);
            DB::table('sede')->insert([
                "nombre_Sede" => "CUCS",
                'turnoMatutino'=> 1,
                'turnoMediodia'=> 1,
                'turnoVespertino'=> 1,
                'turnoSabatino'=> 1,
                'turnoTiempoCompleto'=> 1,
                'turnoNoAplica'=> 1,
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sede');
    }
}
