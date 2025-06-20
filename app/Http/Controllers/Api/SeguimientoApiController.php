<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SeguimientoApiController extends Controller
{
    public function resumenDiario()
    {
        $personaId = Auth::id();
        $hoy = now()->toDateString();

        $resumenDiario = DB::table('seguimientos')
            ->join('comidas', 'seguimientos.id_comida', '=', 'comidas.id')
            ->select(
                'comidas.nombre as comida',
                DB::raw('SUM(comidas.calorias) as calorias'),
                DB::raw('SUM(comidas.azucar) as azucar'),
                DB::raw('SUM(comidas.carbohidratos) as carbohidratos')
            )
            ->where('seguimientos.id_persona', $personaId)
            ->whereDate('seguimientos.fecha', $hoy)
            ->groupBy('comidas.nombre')
            ->get();

        return response()->json($resumenDiario);
    }

    public function graficaSemana()
    {
        $personaId = Auth::id();
        $hoy = now()->toDateString();
        $semanaPasada = now()->subDays(6)->toDateString();

        $datosSemana = DB::table('seguimientos')
            ->join('comidas', 'seguimientos.id_comida', '=', 'comidas.id')
            ->select(
                DB::raw('DATE(seguimientos.fecha) as fecha'),
                DB::raw('SUM(comidas.calorias) as calorias'),
                DB::raw('SUM(comidas.azucar) as azucar'),
                DB::raw('SUM(comidas.carbohidratos) as carbohidratos')
            )
            ->where('seguimientos.id_persona', $personaId)
            ->whereBetween('seguimientos.fecha', [$semanaPasada, $hoy])
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        return response()->json($datosSemana);
    }

    public function graficaHora()
    {
        $personaId = Auth::id();
        $hoy = now()->toDateString();

        $porHora = DB::table('seguimientos')
            ->join('comidas', 'seguimientos.id_comida', '=', 'comidas.id')
            ->select(
                DB::raw('HOUR(seguimientos.created_at) as hora'),
                DB::raw('SUM(comidas.calorias) as calorias'),
                DB::raw('SUM(comidas.azucar) as azucar'),
                DB::raw('SUM(comidas.carbohidratos) as carbohidratos')
            )
            ->where('seguimientos.id_persona', $personaId)
            ->whereDate('seguimientos.fecha', $hoy)
            ->groupBy('hora')
            ->orderBy('hora')
            ->get();

        return response()->json($porHora);
    }
}
