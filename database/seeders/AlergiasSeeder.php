<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AlergiasSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // IDs fijos para que coincidan con ALERGIA_ID_TO_KEY del backend Flask
        $rows = [
            ['id' => 1,  'descripcion' => 'Gluten'],
            ['id' => 2,  'descripcion' => 'Leche'],
            ['id' => 3,  'descripcion' => 'Huevo'],
            ['id' => 4,  'descripcion' => 'Pescado'],
            ['id' => 5,  'descripcion' => 'Mariscos'],
            ['id' => 6,  'descripcion' => 'Crustáceos'],
            ['id' => 7,  'descripcion' => 'Moluscos'],
            ['id' => 8,  'descripcion' => 'Cacahuate'],
            ['id' => 9,  'descripcion' => 'Maní'],
            ['id' => 10, 'descripcion' => 'Frutos secos'],
            ['id' => 11, 'descripcion' => 'Soya'],
            ['id' => 12, 'descripcion' => 'Apio'],
            ['id' => 13, 'descripcion' => 'Mostaza'],
            ['id' => 14, 'descripcion' => 'Ajonjolí'],
            ['id' => 15, 'descripcion' => 'Altramuces'],
            ['id' => 16, 'descripcion' => 'Sulfitos'],
            ['id' => 17, 'descripcion' => 'Maíz'],
            ['id' => 18, 'descripcion' => 'Frijol'],
            ['id' => 19, 'descripcion' => 'Chile'],
            ['id' => 20, 'descripcion' => 'Jitomate'],
            ['id' => 21, 'descripcion' => 'Aguacate'],
            ['id' => 22, 'descripcion' => 'Chocolate'],
            ['id' => 23, 'descripcion' => 'Plátano'],
            ['id' => 24, 'descripcion' => 'Fresas'],
            ['id' => 25, 'descripcion' => 'Frutos rojos'],
            // Mantenemos el 26 como “Frutos rojos” por compatibilidad con tu Flask
            ['id' => 26, 'descripcion' => 'Frutos rojos'],
        ];

        // upsert por id (si existe, actualiza descripcion y updated_at)
        foreach ($rows as &$r) {
            $r['created_at'] = $now;
            $r['updated_at'] = $now;
        }

        // upsert: clave = id; columnas a actualizar = descripcion, updated_at
        DB::table('alergias')->upsert(
            $rows,
            ['id'],
            ['descripcion', 'updated_at']
        );

        // (Opcional) Asegura auto_increment > 26 si la tabla se creó vacía
        try {
            DB::statement('ALTER TABLE alergias AUTO_INCREMENT = 100;');
        } catch (\Throwable $e) {
            // Ignorar si no aplica
        }
    }
}
