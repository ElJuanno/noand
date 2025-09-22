<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Relación con usuario (ajusta tipo si tu users.id no es bigIncrements)
            $table->unsignedBigInteger('id_persona');

            // Fecha/hora del consumo
            $table->date('fecha');
            $table->time('hora')->nullable();

            // Clasificación del tiempo (opcional)
            $table->string('tiempo', 20)->nullable(); // Desayuno/Almuerzo/Comida/Cena/Snack

            // Datos de la comida/receta seguida
            $table->string('nombre');
            $table->decimal('calorias', 10, 1)->default(0);
            $table->decimal('azucar', 10, 1)->default(0);
            $table->decimal('carbohidratos', 10, 1)->default(0);

            $table->json('metadata')->nullable();  // extra (ids, categoría, etc)
            $table->text('notas')->nullable();

            $table->timestamps();

            // Índices útiles
            $table->index(['id_persona', 'fecha']);
            $table->index(['id_persona', 'fecha', 'tiempo']);

            // Si quieres FK estricta (descomenta y asegúrate del tipo):
            // $table->foreign('id_persona')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seguimientos');
    }
};
