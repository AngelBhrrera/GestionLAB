<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateAreasTable extends Migration
{

    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_area', 255);
            $table->boolean('turnoMatutino')->default(0);
            $table->boolean('turnoMediodia')->default(0);
            $table->boolean('turnoVespertino')->default(0);
            $table->boolean('turnoSabatino')->default(0);
            $table->boolean('turnoTiempoCompleto')->default(0);
            $table->boolean('no_Aplica')->default(0);
            $table->boolean('activa')->default(1);
            $table->integer('id_sede');
        });

        DB::table('areas')->insert([
            "nombre_area" => "Inventores",
            'turnoMatutino'=> 1,
            'turnoMediodia'=> 1,
            'turnoVespertino'=> 1,
            'turnoSabatino'=> 1,
            'turnoTiempoCompleto'=> 1,
            'no_Aplica'=> 1,
            'id_sede'=> 1,
        ]);
        DB::table('areas')->insert([
            "nombre_area" => "CORCOM",
            'turnoMatutino'=> 1,
            'turnoMediodia'=> 1,
            'turnoVespertino'=> 1,
            'turnoSabatino'=> 0,
            'turnoTiempoCompleto'=> 0,
            'no_Aplica'=> 1,
            'id_sede'=> 1,
        ]);
        DB::table('areas')->insert([
            "nombre_area" => "Innovación",
            'turnoMatutino'=> 1,
            'turnoMediodia'=> 1,
            'turnoVespertino'=> 1,
            'turnoSabatino'=> 1,
            'turnoTiempoCompleto'=> 1,
            'no_Aplica'=> 0,
            'id_sede'=> 1,
        ]);
        DB::table('areas')->insert([
            "nombre_area" => "CUCS",
            'turnoMatutino'=> 1,
            'turnoMediodia'=> 1,
            'turnoVespertino'=> 1,
            'turnoSabatino'=> 1,
            'turnoTiempoCompleto'=> 1,
            'no_Aplica'=> 1,
            'id_sede'=> 1,
        ]);
        DB::table('areas')->insert([
            "nombre_area" => "SSB",
            'turnoMatutino'=> 0,
            'turnoMediodia'=> 0,
            'turnoVespertino'=> 0,
            'turnoSabatino'=> 1,
            'turnoTiempoCompleto'=> 1,
            'no_Aplica'=> 1,
            'id_sede'=> 2,
        ]);
        DB::table('areas')->insert([
            "nombre_area" => "Inventores",
            'turnoMatutino'=> 1,
            'turnoMediodia'=> 1,
            'turnoVespertino'=> 1,
            'turnoSabatino'=> 1,
            'turnoTiempoCompleto'=> 1,
            'no_Aplica'=> 1,
            'id_sede'=> 4,
        ]);
    }


    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
