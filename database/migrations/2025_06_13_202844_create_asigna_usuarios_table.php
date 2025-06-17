<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAsignaUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asigna_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_especialista')->nullable();
            $table->integer('id_usuario')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('asigna_usuarios');
    }
}
