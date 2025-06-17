<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMedidaAntropometricasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medida_antropometricas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->decimal('peso')->nullable();
            $table->decimal('altura')->nullable();
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
        Schema::drop('medida_antropometricas');
    }
}
