<?php

// database/migrations/2025_09_12_000001_create_alergia_persona_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('alergia_persona', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id')->constrained('personas')->cascadeOnDelete();
            $table->foreignId('alergia_id')->constrained('alergias')->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['id','alergia_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('alergia_persona'); }
};
