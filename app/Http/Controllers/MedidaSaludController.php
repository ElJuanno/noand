<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedidaSalud;
use App\Models\MedidaAntropometrica;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MedidaSaludController extends Controller
{
    /** Formulario para registrar/actualizar medidas (tu vista actual) */
    public function create()
    {
        // Último registro para precargar el form (no lo sobreescribiremos, solo referencia)
        $medidaSalud = MedidaSalud::where('id_persona', Auth::id())
            ->orderByDesc('created_at')->first();

        return view('pages.medidas_salud.registrar', compact('medidaSalud'));
    }

    /** Guarda un NUEVO registro (histórico) */
    public function store(Request $request)
    {
        $request->validate([
            'glucosa'    => 'required|numeric|min:40|max:600',
            'presion'    => 'nullable|string|max:30',   // ej. 120/80
            'frecuencia' => 'nullable|numeric|min:20|max:250',
            'condicion'  => 'nullable|string|max:255',
            'edad'       => 'required|integer|min:1|max:120',
        ]);

        MedidaSalud::create([
            'id_persona'  => Auth::id(),
            'glucosa'     => $request->glucosa,
            'presion'     => $request->presion,
            'frecuencia'  => $request->frecuencia,
            'condicion'   => $request->condicion,
            'edad'        => $request->edad,
        ]);

        // Si prefieres volver al form:
        // return redirect()->route('medidas.salud.create')->with('success', 'Medidas guardadas.');

        return redirect()->route('salud.overview')->with('success', 'Medidas guardadas.');
    }

    /** Vista de monitoreo (solo lectura) */
    public function overview()
    {
        $user = Auth::user();

        // Últimas medidas de salud y antropometría
        $lastSalud = MedidaSalud::where('id_persona', $user->id)->orderByDesc('created_at')->first();
        $prevSalud = MedidaSalud::where('id_persona', $user->id)
            ->where('id', '!=', optional($lastSalud)->id)->orderByDesc('created_at')->first();

        $lastAntro = MedidaAntropometrica::where('id_persona', $user->id)->orderByDesc('created_at')->first();
        $prevAntro = MedidaAntropometrica::where('id_persona', $user->id)
            ->where('id', '!=', optional($lastAntro)->id)->orderByDesc('created_at')->first();

        // IMC
        $imc = null;
        if ($lastAntro && $lastAntro->peso && $lastAntro->altura) {
            // altura en METROS (como ya usabas)
            $imc = round($lastAntro->peso / pow($lastAntro->altura, 2), 1);
        }

        // Clasificaciones/semáforos
        $status = [
            'glucosa' => $this->glucoseStatus(optional($lastSalud)->glucosa),
            'presion' => $this->pressureStatus(optional($lastSalud)->presion),
            'fc'      => $this->hrStatus(optional($lastSalud)->frecuencia),
            'imc'     => $this->bmiStatus($imc),
        ];

        // Series para gráficas (últimas 30)
        $histSalud = MedidaSalud::where('id_persona', $user->id)->orderBy('created_at')->take(30)->get();

        $labels=[]; $glucose=[]; $hr=[]; $sys=[]; $dia=[];
        foreach ($histSalud as $row) {
            $labels[]  = Carbon::parse($row->created_at)->format('d/m');
            $glucose[] = (float)($row->glucosa ?? 0);
            $hr[]      = (float)($row->frecuencia ?? 0);
            [$s,$d]    = $this->parsePressure($row->presion);
            $sys[]     = $s;  $dia[] = $d;
        }

        // IMC histórico (últimas 30 antropometrías)
        $histAntro = MedidaAntropometrica::where('id_persona', $user->id)->orderBy('created_at')->take(30)->get();

        $labelsBmi=[]; $bmiSeries=[];
        $lastHeight = optional($lastAntro)->altura;
        foreach ($histAntro as $row) {
            $labelsBmi[] = Carbon::parse($row->created_at)->format('d/m');
            $h = $row->altura ?: $lastHeight;
            $bmiSeries[] = ($h && $row->peso) ? round($row->peso / pow($h,2), 1) : null;
        }

        return view('pages.salud_overview', compact(
            'lastSalud','lastAntro','prevSalud','prevAntro','imc','status',
            'labels','glucose','hr','sys','dia',
            'labelsBmi','bmiSeries'
        ));
    }

    /* ----------------- Helpers ----------------- */

    private function parsePressure($presion)
    {
        if (!$presion) return [0,0];
        if (preg_match('/(\d{2,3})\D+(\d{2,3})/', $presion, $m)) {
            return [(int)$m[1], (int)$m[2]];
        }
        return [0,0];
    }

    private function glucoseStatus($g)
    {
        if ($g === null) return ['label'=>'Sin dato','class'=>'secondary'];
        $g = (float)$g;
        if ($g < 70)    return ['label'=>'Baja','class'=>'warning'];
        if ($g <= 99)   return ['label'=>'Normal','class'=>'success'];
        if ($g <= 125)  return ['label'=>'Pre','class'=>'warning'];
        return ['label'=>'Alta','class'=>'danger'];
    }

    private function pressureStatus($p)
    {
        [$s,$d] = $this->parsePressure($p);
        if ($s===0 && $d===0) return ['label'=>'Sin dato','class'=>'secondary'];

        // AHA 2017
        if ($s < 120 && $d < 80) return ['label'=>'Normal','class'=>'success'];
        if ($s >=120 && $s <=129 && $d < 80) return ['label'=>'Elevada','class'=>'warning'];
        if (($s >=130 && $s <=139) || ($d >=80 && $d <=89)) return ['label'=>'HTA 1','class'=>'warning'];
        if ($s >=140 || $d >=90) return ['label'=>'HTA 2','class'=>'danger'];
        return ['label'=>'Revisar','class'=>'secondary'];
    }

    private function hrStatus($hr)
    {
        if ($hr === null) return ['label'=>'Sin dato','class'=>'secondary'];
        $hr = (int)$hr;
        if ($hr < 60)  return ['label'=>'Baja','class'=>'warning'];
        if ($hr <=100) return ['label'=>'Normal','class'=>'success'];
        return ['label'=>'Alta','class'=>'danger'];
    }

    private function bmiStatus($bmi)
    {
        if ($bmi === null) return ['label'=>'Sin dato','class'=>'secondary'];
        if ($bmi < 18.5) return ['label'=>'Bajo peso','class'=>'warning'];
        if ($bmi < 25)   return ['label'=>'Normal','class'=>'success'];
        if ($bmi < 30)   return ['label'=>'Sobrepeso','class'=>'warning'];
        return ['label'=>'Obesidad','class'=>'danger'];
    }
}
