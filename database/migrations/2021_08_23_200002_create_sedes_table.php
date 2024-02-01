<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSedesTable extends Migration
{
    protected $table =  'sede';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->id('id_sede');
            $table->string('nombre_sede')->default(0);
        });

        DB::table('sedes')->insert([
            "nombre_sede" => "CUCEI"
        ]);
        DB::table('sedes')->insert([
            "nombre_sede" => "CFE"
        ]);
        DB::table('sedes')->insert([
            "nombre_sede" => "ECRO"
        ]);
        DB::table('sedes')->insert([
            "nombre_sede" => "CUTonala"
        ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sedes');
    }
}
