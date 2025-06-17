<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReporteNutricionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_nutricionals', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_persona')->nullable();
            $table->text('observaciones')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('reporte_nutricionals');
    }
}
