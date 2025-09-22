@extends('layouts.app')

@section('title','Mi salud')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<style>
:root{
  --brand:#2b8a3e; --brand2:#3fa55a; --bg:#edf7ef; --card:#fff;
  --muted:#6a8b74; --line:#e7f0ea; --text:#23452d;
}
body{ background:var(--bg)!important; color:var(--text); }
.wrap{ max-width:1100px; margin:24px auto; padding:0 16px; }

.tile{
  background:var(--card); border:1px solid var(--line); border-radius:16px;
  box-shadow:0 6px 18px rgba(43,138,62,.06); padding:18px 16px;
}
.h-title{ font-weight:900; color:var(--brand); margin:0; }
.h-sub{ color:var(--muted); }

.kpi{
  border:1px solid var(--line); border-radius:16px; padding:14px 16px; background:#fff;
  height:100%;
}
.kpi .label{ color:var(--muted); font-size:.9rem; margin-bottom:6px; }
.kpi .val{ font-size:1.6rem; font-weight:800; color:var(--brand); }
.kpi .trend{ font-size:.85rem; }
.badge-outline{
  border:1px solid var(--line); color:var(--brand); background:#f5fbf7;
  border-radius:999px; padding:.25rem .6rem; font-weight:700; font-size:.8rem;
}

.chart-card{ background:#fff; border:1px solid var(--line); border-radius:16px; padding:16px; }
.chart-title{ font-weight:800; color:var(--brand); margin-bottom:.4rem; }
.small-muted{ color:var(--muted); font-size:.9rem; }

.btn-green{ background:linear-gradient(180deg,var(--brand2),var(--brand)); color:#fff; border:none; }
.btn-green:hover{ filter:brightness(.95); }
</style>
<br><br>

<div class="wrap">

  {{-- Encabezado --}}
  <div class="tile mb-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
    <div>
      <h2 class="h-title mb-1">Mi salud</h2>
      <div class="h-sub">Resumen de tus últimas mediciones y evolución.</div>
    </div>
    <div class="d-flex gap-2 flex-wrap">
      <a href="{{ route('medidas.salud.create') }}" class="btn btn-green">
        <i class="bi bi-plus-circle"></i> Actualizar datos
      </a>
    </div>
  </div>

  @if(!$lastSalud && !$lastAntro)
    <div class="tile text-center">
      Aún no has registrado medidas. <a href="{{ route('medidas.salud.create') }}">Registra aquí</a> tus primeros datos.
    </div>
  @else

  {{-- KPIs --}}
  <div class="row g-3 mb-3">
    <div class="col-12 col-md-3">
      <div class="kpi">
        <div class="label">Glucosa (mg/dL)</div>
        <div class="val">{{ optional($lastSalud)->glucosa ?? '—' }}</div>
        <span class="badge text-bg-{{ $status['glucosa']['class'] }}">{{ $status['glucosa']['label'] }}</span>
        @if($prevSalud && $lastSalud && $prevSalud->glucosa !== null && $lastSalud->glucosa !== null)
          <div class="trend mt-1 small-muted">
            @php $dg = (float)$lastSalud->glucosa - (float)$prevSalud->glucosa; @endphp
            Variación: <strong class="{{ $dg>=0?'text-danger':'text-success' }}">{{ $dg>=0?'+':'' }}{{ $dg }}</strong>
          </div>
        @endif
      </div>
    </div>

    <div class="col-12 col-md-3">
      <div class="kpi">
        <div class="label">Presión arterial</div>
        <div class="val">{{ optional($lastSalud)->presion ?? '—' }}</div>
        <span class="badge text-bg-{{ $status['presion']['class'] }}">{{ $status['presion']['label'] }}</span>
        @if($prevSalud && $prevSalud->presion && $lastSalud && $lastSalud->presion)
          <div class="trend mt-1 small-muted">Comparada con registro anterior</div>
        @endif
      </div>
    </div>

    <div class="col-12 col-md-3">
      <div class="kpi">
        <div class="label">Frecuencia cardiaca</div>
        <div class="val">{{ optional($lastSalud)->frecuencia ?? '—' }} <small>lpm</small></div>
        <span class="badge text-bg-{{ $status['fc']['class'] }}">{{ $status['fc']['label'] }}</span>
      </div>
    </div>

    <div class="col-12 col-md-3">
      <div class="kpi">
        <div class="label">IMC</div>
        <div class="val">{{ $imc !== null ? $imc : '—' }}</div>
        <span class="badge text-bg-{{ $status['imc']['class'] }}">{{ $status['imc']['label'] }}</span>
        @if($lastAntro && $prevAntro && $lastAntro->peso && $prevAntro->peso)
          @php
            $h = $lastAntro->altura ?: $prevAntro->altura;
            $prevBmi = ($h ? round($prevAntro->peso / pow($h,2),1) : null);
          @endphp
          @if($prevBmi !== null && $imc !== null)
            <div class="trend mt-1 small-muted">
              Variación: <strong class="{{ $imc-$prevBmi>=0?'text-danger':'text-success' }}">{{ $imc-$prevBmi>=0?'+':'' }}{{ number_format($imc-$prevBmi,1) }}</strong>
            </div>
          @endif
        @endif
      </div>
    </div>
  </div>

  {{-- GRÁFICOS --}}
  <div class="row g-3">
    <div class="col-12 col-lg-6">
      <div class="chart-card">
        <div class="chart-title">Glucosa & Frecuencia</div>
        <div class="small-muted mb-1">Últimas mediciones registradas</div>
        <canvas id="chartGF" height="150"></canvas>
      </div>
    </div>
    <div class="col-12 col-lg-6">
      <div class="chart-card">
        <div class="chart-title">Presión arterial</div>
        <div class="small-muted mb-1">Sistólica / Diastólica</div>
        <canvas id="chartBP" height="150"></canvas>
      </div>
    </div>
  @endif
</div>

<script>
const LABELS   = @json($labels);
const GLU     = @json($glucose);
const HR      = @json($hr);
const SYS     = @json($sys);
const DIA     = @json($dia);
const BMI_L   = @json($labelsBmi);
const BMI_S   = @json($bmiSeries);

// Glucosa + FC
(() => {
  const ctx = document.getElementById('chartGF');
  if (!ctx) return;
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: LABELS,
      datasets: [
        { label:'Glucosa', data: GLU, yAxisID:'y', tension:.3 },
        { label:'Frecuencia (lpm)', data: HR, yAxisID:'y1', tension:.3 }
      ]
    },
    options: {
      responsive:true, interaction:{mode:'index', intersect:false},
      scales: {
        y:  { title:{display:true,text:'mg/dL'} },
        y1: { position:'right', grid:{ drawOnChartArea:false }, title:{display:true,text:'lpm'}}
      }
    }
  });
})();

// Presión arterial
(() => {
  const ctx = document.getElementById('chartBP');
  if (!ctx) return;
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: LABELS,
      datasets: [
        { label:'Sistólica', data: SYS, tension:.3 },
        { label:'Diastólica', data: DIA, tension:.3 }
      ]
    },
    options: {
      responsive:true, interaction:{mode:'index', intersect:false},
      scales: { y: { title:{display:true,text:'mmHg'} } }
    }
  });
})();
</script>
@endsection
