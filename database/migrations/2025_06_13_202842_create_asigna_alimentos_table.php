<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAsignaAlimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asigna_alimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_comida')->nullable();
            $table->integer('id_alimento')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('asigna_alimentos');
    }
}
