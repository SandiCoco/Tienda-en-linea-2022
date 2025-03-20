<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('correo')->unique();
            $table->string('usuario')->unique();
            $table->string('password')->max(8);
            $table->integer('edad')->nullable();
            $table->string('foto')->nullable();
            $table->string('pais')->nullable();
            $table->string('direccion')->nullable();
            $table->string('direccion_envio')->nullable(); 
            $table->string('rol')->default('Usuario');
            $table->boolean('referido')->default(false);
            $table->boolean('nuevo')->default(true);
            $table->timestamps();
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
};
