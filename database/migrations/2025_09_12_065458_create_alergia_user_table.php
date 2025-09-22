<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alergia_persona');
    }
};
