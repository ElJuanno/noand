<?php

namespace App\Http\Controllers;

use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeguimientoController extends Controller
{
    public function index(Request $request)
    {
        $user  = Auth::user();

        // Semana actual (Lun–Dom)
        $start = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $end   = (clone $start)->endOfWeek(Carbon::SUNDAY);

        // Listado de la semana
        $items = Seguimiento::where('id_persona', $user->id)
            ->whereBetween('fecha', [$start->toDateString(), $end->toDateString()])
            ->orderBy('fecha')->orderBy('hora')
            ->get();

        // Agregados por día para la gráfica (sin JOINS)
        $porDia = Seguimiento::selectRaw('fecha, SUM(calorias) cal, SUM(azucar) sugar, SUM(carbohidratos) carbs')
            ->where('id_persona', $user->id)
            ->whereBetween('fecha', [$start->toDateString(), $end->toDateString()])
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        // Series para Chart.js
        $labels = $cals = $sugars = $carbs = [];
        for ($i=0; $i<7; $i++) {
            $d = (clone $start)->addDays($i)->toDateString();
            $labels[] = Carbon::parse($d)->translatedFormat('D d');
            $row = $porDia->firstWhere('fecha', $d);
            $cals[]   = $row->cal   ?? 0;
            $sugars[] = $row->sugar ?? 0;
            $carbs[]  = $row->carbs ?? 0;
        }

        // Resúmenes útiles SIN joins
        $hoy = Carbon::today()->toDateString();
        $resumenHoy = $this->resumenPorFecha($user->id, $hoy);                    // group by nombre
        $topSemana  = $this->resumenPorRangoGroupNombre($user->id, $start, $end); // top 10 por calorías

        // Historial paginado completo
        $historial = Seguimiento::where('id_persona', $user->id)
            ->orderByDesc('fecha')->orderByDesc('hora')
            ->paginate(10);

        return view('pages.registro_comidas', [
            'items'     => $items,
            'labels'    => $labels,
            'cals'      => $cals,
            'sugars'    => $sugars,
            'carbs'     => $carbs,
            'sumCal'    => array_sum($cals),
            'sumSugar'  => array_sum($sugars),
            'sumCarbs'  => array_sum($carbs),
            'start'     => $start,
            'end'       => $end,
            'historial' => $historial,
            'resumenHoy'=> $resumenHoy,
            'topSemana' => $topSemana,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'         => 'required|string|max:255',
            'tiempo'         => 'nullable|string|max:20',
            'fecha'          => 'nullable|date',
            'hora'           => 'nullable',
            'calorias'       => 'nullable|numeric|min:0',
            'azucar'         => 'nullable|numeric|min:0',
            'carbohidratos'  => 'nullable|numeric|min:0',
            'notas'          => 'nullable|string|max:2000',
        ]);

        Seguimiento::create([
            'id_persona'    => Auth::id(),
            'fecha'         => $data['fecha'] ?? now()->toDateString(),
            'hora'          => $data['hora'] ?? now()->format('H:i:s'),
            'tiempo'        => $data['tiempo'] ?? null,
            'nombre'        => $data['nombre'],
            'calorias'      => $data['calorias'] ?? 0,
            'azucar'        => $data['azucar'] ?? 0,
            'carbohidratos' => $data['carbohidratos'] ?? 0,
            'notas'         => $data['notas'] ?? null,
            'metadata'      => ['source' => $request->input('source', 'plan')],
        ]);

        return back()->with('success','Comida registrada en tu seguimiento.');
    }

    public function destroy(Seguimiento $seguimiento)
    {
        abort_unless($seguimiento->id_persona === Auth::id(), 403);
        $seguimiento->delete();
        return back()->with('success','Registro eliminado.');
    }

    /* =============================== Helpers SIN JOIN =============================== */

    /** Resumen del día agrupado por nombre (sin JOIN a comidas) */
    private function resumenPorFecha(int $userId, string $date)
    {
        return Seguimiento::selectRaw('
                nombre,
                SUM(calorias)      as calorias,
                SUM(azucar)        as azucar,
                SUM(carbohidratos) as carbohidratos
            ')
            ->where('id_persona', $userId)
            ->whereDate('fecha', $date)
            ->groupBy('nombre')
            ->orderByDesc(DB::raw('SUM(calorias)'))
            ->get();
    }

    /** Top 10 de la semana agrupado por nombre (sin JOIN a comidas) */
    private function resumenPorRangoGroupNombre(int $userId, Carbon $start, Carbon $end)
    {
        return Seguimiento::selectRaw('
                nombre,
                SUM(calorias)      as calorias,
                SUM(azucar)        as azucar,
                SUM(carbohidratos) as carbohidratos
            ')
            ->where('id_persona', $userId)
            ->whereBetween('fecha', [$start->toDateString(), $end->toDateString()])
            ->groupBy('nombre')
            ->orderByDesc(DB::raw('SUM(calorias)'))
            ->limit(10)
            ->get();
    }
}
