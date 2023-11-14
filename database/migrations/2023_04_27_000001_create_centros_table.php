<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centros', function (Blueprint $table) {
            $table->string('centro', 50)->collation('utf8mb4_unicode_ci');
        });

        DB::table('centros')->insert([
            ['centro' => 'CUCEI'],
            ['centro' => 'CUAAD'],
            ['centro' => 'CUCEA'],
            ['centro' => 'CUCBA'],
            ['centro' => 'CUCSH'],
            ['centro' => 'CUCS'],
            ['centro' => 'CUNORTE'],
            ['centro' => 'CULAGOS'],
            ['centro' => 'CUVALLE'],
            ['centro' => 'CUALTOS'],
            ['centro' => 'CUCOSTA'],
            ['centro' => 'CUTONALA'],
            ['centro' => 'CUCIENEGA'],
            ['centro' => 'CUCSUR'],
            ['centro' => 'CUSUR'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centros');
    }
}
