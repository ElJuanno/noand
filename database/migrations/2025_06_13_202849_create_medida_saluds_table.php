<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedidaSaludsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medida_saluds', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('presion')->nullable();
            $table->integer('frecuencia')->nullable();
            $table->integer('id_persona')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medida_saluds');
    }
}
