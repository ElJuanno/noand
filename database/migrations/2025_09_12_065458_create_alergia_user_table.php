<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alergia_persona', function (Blueprint $table) {
            // ID autoincremental
            $table->id();

            // Foreign Keys
            $table->unsignedBigInteger('persona_id');
            $table->unsignedBigInteger('alergia_id');

            // Relaciones
            $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('alergia_id')->references('id')->on('alergias')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alergia_persona');
    }
};
