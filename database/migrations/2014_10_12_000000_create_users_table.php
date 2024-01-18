<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('name', 150);
            $table->string('apellido', 150);
            $table->string('correo', 50)->unique();
            $table->string('codigo', 191)->unique()->nullable();
            $table->string('tipo', 50);
            $table->string('telefono', 10)->unique()->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 191);
            $table->rememberToken();
            $table->timestamps();
            //$table->boolean('can_admin')->nullable()->default(0);

            $table->unsignedInteger('horas')->nullable();
            $table->string('fecha_salida', 100)->nullable();


            $table->string('carrera')->nullable();
            $table->tinyText('centro')->nullable();
            $table->tinyInteger('sede')->default(0)->nullable();
            $table->string('horario', 100)->nullable();
            $table->unsignedBigInteger('encargado_id')->nullable();

            $table->string('imagen_perfil', 255)->nullable();
            $table->unsignedInteger('experiencia')->default(1)->nullable();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
