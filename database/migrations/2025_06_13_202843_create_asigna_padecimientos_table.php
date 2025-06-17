<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAsignaPadecimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asigna_padecimientos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_persona')->nullable();
            $table->integer('id_enfermedad')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('asigna_padecimientos');
    }
}
