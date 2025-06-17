<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ComidaController extends Controller
{
    // Mostrar resumen diario de comidas seguidas por el usuario
    public function create()
    {
        $personaId = Auth::id();
        $hoy = now()->toDateString();
        $semanaPasada = now()->subDays(6)->toDateString();

        // Resumen diario
        $resumenDiario = DB::table('seguimientos')
            ->join('comidas', 'seguimientos.id_comida', '=', 'comidas.id')
            ->select('comidas.nombre as comida', DB::raw('SUM(comidas.calorias) as calorias'), DB::raw('SUM(comidas.azucar) as azucar'), DB::raw('SUM(comidas.carbohidratos) as carbohidratos'))
            ->where('seguimientos.id_persona', $personaId)
            ->whereDate('seguimientos.fecha', $hoy)
            ->groupBy('comidas.nombre')
            ->get();

        // Gráfica semanal (por fecha)
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

        // Gráfica por hora
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

        return view('pages.comida.create', compact('resumenDiario', 'datosSemana', 'porHora'));
    }




    // Guardar la comida que se sigue (desde el plan alimenticio)
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'hora' => 'required|string',
            'calorias' => 'required|numeric',
            'azucar' => 'required|numeric',
            'carbohidratos' => 'required|numeric',
        ]);

        $nombre = $request->input('nombre');
        $hora = $request->input('hora');
        $calorias = $request->input('calorias');
        $azucar = $request->input('azucar');
        $carbohidratos = $request->input('carbohidratos');

        $personaId = Auth::id();
        $fechaHoy = now()->toDateString();

        // Buscar si ya existe la comida
        $comida = DB::table('comidas')->where('nombre', $nombre)->first();

        if (!$comida) {
            $comidaId = DB::table('comidas')->insertGetId([
                'nombre' => $nombre,
                'horario' => $hora,
                'calorias' => $calorias,
                'azucar' => $azucar,
                'carbohidratos' => $carbohidratos,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $comidaId = $comida->id;
        }

        // Registrar el seguimiento
        DB::table('seguimientos')->insert([
            'id_persona' => $personaId,
            'id_comida'  => $comidaId,
            'fecha'      => $fechaHoy,
            'notas'      => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Comida registrada correctamente.');
    }
}
