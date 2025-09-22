<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD
return new class extends Migration {
    public function up(): void
    {
        Schema::create('alergia_persona', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            // PK del pivot (puede ser big o normal, no importa, es independiente)
            $table->bigIncrements('id');

            // ¡OJO!: tipos que coinciden con las tablas padre
            $table->unsignedBigInteger('id_persona'); // personas.id -> bigint unsigned
            $table->unsignedInteger('alergia_id');    // alergias.id -> int unsigned

            $table->timestamps();

            // FKs
            $table->foreign('id_persona')
                ->references('id')->on('personas')
                ->onDelete('cascade');

            $table->foreign('alergia_id')
                ->references('id')->on('alergias')
                ->onDelete('cascade');

            // Evitar duplicados
            $table->unique(['id_persona', 'alergia_id']);
=======
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
>>>>>>> 9c3deba2bb2f1d48edfd05153448f6142dbaf5fb
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alergia_persona');
    }
};
