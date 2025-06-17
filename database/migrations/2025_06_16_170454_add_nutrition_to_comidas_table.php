<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('comidas', function (Blueprint $table) {
            $table->decimal('calorias', 8, 2)->nullable();
            $table->decimal('azucar', 8, 2)->nullable();
            $table->decimal('carbohidratos', 8, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('comidas', function (Blueprint $table) {
            $table->dropColumn(['calorias', 'azucar', 'carbohidratos']);
        });
    }

};
