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
        Schema::table('medida_saluds', function (Blueprint $table) {
            $table->float('glucosa')->nullable()->after('frecuencia');
            $table->string('condicion')->nullable()->after('glucosa');
            $table->integer('edad')->nullable()->after('condicion');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('medida_saluds', function (Blueprint $table) {
            $table->dropColumn(['glucosa', 'condicion', 'edad']);
        });
    }

};
