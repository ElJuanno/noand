<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class ImagenRecetaHelper
{
    // Tu client id de Unsplash si quieres como plan B
    const UNSPLASH_CLIENT_ID = 'byYWuq85axbeyLYGXCKX7b3aK6cPQV6l1Uim4FD7rbk';

    public static function palabrasClave($receta)
    {
        // Extrae posibles palabras para buscar imagen
        $candidatos = [];
        if (!empty($receta['nombre'])) {
            // Quita cosas después de coma, guión, etc.
            $base = preg_replace('/[,(\-].*$/', '', $receta['nombre']);
            // Divide en palabras, elimina duplicados, quita palabras comunes
            $palabras = preg_split('/[\s_]+/', strtolower($base));
            $prohibidas = ['and', 'the', 'with', 'in', 'a', 'of', 'to', 'on', 'ii', 'i', 'de', 'la', 'el', 'en', 'con', 'y'];
            foreach ($palabras as $p) {
                if (strlen($p) > 2 && !in_array($p, $prohibidas)) {
                    $candidatos[] = ucfirst($p);
                }
            }
        }
        if (!empty($receta['categoria'])) {
            $candidatos[] = ucfirst($receta['categoria']);
        }
        // Quita duplicados
        return array_unique($candidatos);
    }

    public static function buscarImagen($nombreReceta, $categoriaReceta = '')
    {
        if (!$nombreReceta) return asset('imagenes/comida_default.png');
        $receta = ['nombre' => $nombreReceta, 'categoria' => $categoriaReceta];

        return Cache::remember('img_receta_' . md5($nombreReceta . $categoriaReceta), 60*24*7, function() use ($receta) {
            $palabras = self::palabrasClave($receta);

            // Intenta varias búsquedas en TheMealDB
            foreach ($palabras as $palabra) {
                $url = "https://www.themealdb.com/api/json/v1/1/search.php?s=" . urlencode($palabra);
                $response = Http::get($url);
                if ($response->successful()) {
                    $json = $response->json();
                    if (!empty($json['meals'])) {
                        // Elige aleatoria entre los resultados (más divertido)
                        $meal = $json['meals'][array_rand($json['meals'])];
                        $img = $meal['strMealThumb'] ?? null;
                        if ($img) return $img;
                    }
                }
            }

            // Ahora busca en Unsplash solo si tienes clave
            if (self::UNSPLASH_CLIENT_ID && self::UNSPLASH_CLIENT_ID != 'TU_CLIENT_ID_DE_UNSPLASH') {
                foreach ($palabras as $palabra) {
                    $urlUnsplash = "https://api.unsplash.com/search/photos?query=" . urlencode($palabra) . "&client_id=" . self::UNSPLASH_CLIENT_ID . "&per_page=1";
                    $resp = Http::get($urlUnsplash);
                    if ($resp->successful()) {
                        $json = $resp->json();
                        if (!empty($json['results'][0]['urls']['regular'])) {
                            return $json['results'][0]['urls']['regular'];
                        }
                    }
                }
            }

            // Si no encontró nada, regresa imagen default
            return asset('imagenes/comida_default.png');
        });
    }
}
