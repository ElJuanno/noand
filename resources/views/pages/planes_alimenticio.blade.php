@extends('layouts.app')

@section('title', 'Plan alimenticio')

@section('content')
@php
    $modoActual = $modo ?? 'semanal4';
    $isSemanal  = in_array($modoActual, ['semanal4','semanal3']);
    $tiemposDia = $modoActual==='semanal4' ? ['Desayuno','Almuerzo','Comida','Cena'] : ['Desayuno','Comida','Cena'];

    function limpiarIngredientes($ingredientes) {
        if (!$ingredientes) return '';
        if (preg_match('/^c\((.*)\)$/', trim($ingredientes), $m)) {
            $contenido = $m[1];
            $items = preg_split('/",\s*"|\',\s*\'/', trim($contenido, '"\' '));
            return implode(', ', $items);
        }
        return $ingredientes;
    }
@endphp

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
:root{
  --brand: #2b8a3e;
  --brand-2: #3fa55a;
  --bg: #edf7ef;
  --card-bg: #ffffff;
  --text: #23452d;
  --muted: #6a8b74;
  --ring: rgba(43,138,62,.15);
}
body{ background: var(--bg) !important; color: var(--text); }

/* Tile */
.tile{
  background: var(--card-bg);
  border: 1px solid #e7f0ea;
  border-radius: 16px;
  box-shadow: 0 6px 18px rgba(43,138,62,.06);
  padding: 20px 18px;
}
.tile h5{ font-weight: 800; color: var(--brand); }
.tile-muted{ color: var(--muted); font-size: .95rem; }

/* Pills modo */
.mode-pills .btn{
  border-radius: 999px;
  font-weight: 700;
  border: 1px solid #e7f0ea;
  color: var(--brand);
  background: #f5fbf7;
}
.mode-pills .btn.active{
  color: #fff;
  background: linear-gradient(180deg, var(--brand-2), var(--brand));
  border-color: var(--brand);
  box-shadow: 0 0 0 0.2rem var(--ring);
}

/* Cards recetas */
.card-meal{
  background: var(--card-bg);
  border: 1px solid #e7f0ea;
  border-left: 6px solid var(--brand);
  border-radius: 16px;
  box-shadow: 0 6px 18px rgba(43,138,62,.06);
  height: 100%;
  transition: transform .15s ease, box-shadow .15s ease;
}
.card-meal:hover{ transform: translateY(-3px); box-shadow: 0 10px 20px rgba(43,138,62,.10); }
.card-meal.warn{ border-left-color: #f59e0b; }
.card-meal.danger{ border-left-color: #ef4444; }
.card-meal .title{ font-weight: 800; color: var(--brand); font-size: 1.05rem; }
.badge-soft{
  background: #f3faf5; color: var(--brand); border: 1px solid #e7f0ea;
  font-weight: 700; border-radius: 999px; padding: .3rem .6rem; font-size: .8rem;
}
.stat{ color: var(--muted); font-size: .9rem; margin-right: .6rem; }

/* Tabs días */
.day-tab-btn{
  border: 1px solid #e7f0ea; color: var(--brand); background:#f5fbf7;
  font-weight: 700; border-radius: 12px; padding: .45rem .8rem; margin: .2rem;
  cursor: pointer;
}
.day-tab-btn.active{ color: #fff; background: var(--brand); border-color: var(--brand); }

.section-title{ font-weight: 800; color: var(--brand); }
.small-muted{ color: var(--muted); }

/* Scroll horizontal */
.scroller{
  display: grid; grid-auto-flow: column; grid-auto-columns: minmax(280px, 1fr);
  gap: 16px; overflow-x: auto; padding-bottom: 4px;
}
</style>
<br><br><br>
<div class="container py-4" style="max-width:1100px;">
  {{-- Encabezado --}}
  <div class="tile mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div>
        <h3 class="mb-1" style="font-weight: 900; color: var(--brand); text-center">Bienvenido a tu plan</h3>
        <div class="tile-muted">Generado con tus medidas guardadas.</div>
      </div>
      <div class="text-end">
        <div class="badge-soft me-1"><i class="bi bi-activity"></i> IMC: {{ $imc ?? '—' }}</div>
        <div class="badge-soft"><i class="bi bi-droplet-half"></i> Glucosa: {{ $glucosa ?? '—' }}</div>
      </div>
    </div>
    <div class="mt-3 mode-pills d-flex gap-2">
      <button type="button" class="btn {{ $modoActual==='agrupadas' ? 'active' : '' }}" data-target="#view-recetas">Recetas</button>
      <button type="button" class="btn {{ $isSemanal ? 'active' : '' }}" data-target="#view-semanal">Semanal</button>
    </div>
  </div>

  {{-- ===== Recetas agrupadas ===== --}}
  <div id="view-recetas" style="{{ $modoActual==='agrupadas' ? '' : 'display:none' }}">
    @php $orden = ['Desayuno','Almuerzo','Comida','Cena','Snack']; @endphp
    @if(isset($agrupadas) && is_array($agrupadas) && count($agrupadas))
      @foreach($orden as $grupo)
        @php $lista = $agrupadas[$grupo] ?? []; @endphp
        @if(is_array($lista) && count($lista))
          <h5 class="section-title mb-2">{{ $grupo }}</h5>
          <div class="scroller">
            @foreach($lista as $rec)
              @php
                $ing = limpiarIngredientes($rec['ingredientes'] ?? '');
                $class = match($rec['color'] ?? 'verde') { 'amarillo'=>'warn', 'rojo'=>'danger', default=>'' };
              @endphp
              <div class="card-meal {{ $class }}">
                <div class="p-3">
                  <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="badge-soft"><i class="bi bi-tags"></i> {{ $rec['categoria'] ?? '—' }}</span>
                  </div>
                  <div class="title mb-1">{{ $rec['nombre'] ?? 'Sin nombre' }}</div>
                  <div class="small-muted mb-2"><i class="bi bi-list-ul"></i>
                    {{ \Illuminate\Support\Str::limit($ing, 120) }}
                  </div>
                  <div class="mb-2">
                    <span class="stat"><i class="bi bi-fire"></i> {{ $rec['calorias'] ?? 'N/A' }} cal</span>
                    <span class="stat"><i class="bi bi-droplet"></i> {{ $rec['azucar'] ?? 'N/A' }}</span>
                    <span class="stat"><i class="bi bi-box"></i> {{ $rec['carbohidratos'] ?? 'N/A' }}</span>
                  </div>
                  <form action="{{ route('seguimiento.store') }}" method="POST" class="mt-2">
                      @csrf
                      <input type="hidden" name="nombre"        value="{{ $r['nombre'] ?? '' }}">
                      <input type="hidden" name="tiempo"        value="{{ $t }}">
                      <input type="hidden" name="fecha"         value="{{ now()->toDateString() }}">
                      <input type="hidden" name="hora"          value="{{ now()->format('H:i:s') }}">
                      <input type="hidden" name="calorias"      value="{{ $r['calorias'] ?? 0 }}">
                      <input type="hidden" name="azucar"        value="{{ $r['azucar'] ?? 0 }}">
                      <input type="hidden" name="carbohidratos" value="{{ $r['carbohidratos'] ?? 0 }}">
                      <button type="submit" class="btn btn-success btn-sm w-100">Seguir</button>
                  </form>
                </div>
              </div>
            @endforeach
          </div>
        @endif
      @endforeach
    @else
      <div class="tile text-center">No encontramos recetas con tus parámetros actuales.</div>
    @endif
  </div>

  {{-- ===== Plan semanal ===== --}}
  <div id="view-semanal" style="{{ $isSemanal ? '' : 'display:none' }}">
    @if($isSemanal && isset($semanal['dias']) && count($semanal['dias']))
      <h5 class="section-title mb-2">Plan semanal</h5>

      <div class="mb-3 d-flex flex-wrap">
        @foreach($semanal['dias'] as $idx => $d)
          <button class="day-tab-btn {{ $idx===0 ? 'active' : '' }}" data-target="#dia{{ $d['dia'] }}">
            Día {{ $d['dia'] }}
          </button>
        @endforeach
      </div>

      <div class="tab-content">
        @foreach($semanal['dias'] as $idx => $d)
          <div class="tab-pane {{ $idx===0 ? 'show active' : '' }}" id="dia{{ $d['dia'] }}">
            <div class="row g-3">
              @foreach($tiemposDia as $t)
                @php
                  $r = $d[$t] ?? [];
                  $ing = limpiarIngredientes($r['ingredientes'] ?? '');
                  $class = match($r['color'] ?? 'verde') { 'amarillo'=>'warn', 'rojo'=>'danger', default=>'' };
                  $icon = match($t){ 'Desayuno'=>'bi-sunrise', 'Almuerzo'=>'bi-egg-fried', 'Comida'=>'bi-plate', 'Cena'=>'bi-moon', default=>'bi-apple' };
                @endphp
                <div class="col-md-6 col-lg-3 d-flex">
                  <div class="card-meal {{ $class }} w-100">
                    <div class="p-3 d-flex flex-column">
                      <div class="d-flex align-items-center justify-content-between">
                        <span class="badge-soft"><i class="bi {{ $icon }}"></i> {{ $t }}</span>
                        <span class="small-muted">{{ $r['categoria'] ?? '—' }}</span>
                      </div>
                      <div class="title mt-2 mb-1">{{ $r['nombre'] ?? '—' }}</div>
                      <div class="small-muted mb-2"><i class="bi bi-list-ul"></i>
                        {{ \Illuminate\Support\Str::limit($ing, 110) }}
                      </div>
                      <div class="mb-2">
                        <span class="stat"><i class="bi bi-fire"></i> {{ $r['calorias'] ?? 'N/A' }} cal</span>
                        <span class="stat"><i class="bi bi-droplet"></i> {{ $r['azucar'] ?? 'N/A' }}</span>
                        <span class="stat"><i class="bi bi-box"></i> {{ $r['carbohidratos'] ?? 'N/A' }}</span>
                      </div>
                      <div class="mt-auto">
                        <form action="{{ route('seguimiento.store') }}" method="POST">
                          @csrf
                          <input type="hidden" name="nombre" value="{{ $r['nombre'] ?? '' }}">
                          <input type="hidden" name="hora" value="{{ now()->format('H:i:s') }}">
                          <input type="hidden" name="calorias" value="{{ $r['calorias'] ?? 0 }}">
                          <input type="hidden" name="azucar" value="{{ $r['azucar'] ?? 0 }}">
                          <input type="hidden" name="carbohidratos" value="{{ $r['carbohidratos'] ?? 0 }}">
                          <button class="btn btn-success w-100">Seguir</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="tile text-center">No pudimos generar tu plan semanal.</div>
    @endif
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // Toggle entre Recetas y Semanal
  document.querySelectorAll('.mode-pills .btn').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.mode-pills .btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      document.querySelector('#view-recetas').style.display = btn.dataset.target === '#view-recetas' ? '' : 'none';
      document.querySelector('#view-semanal').style.display = btn.dataset.target === '#view-semanal' ? '' : 'none';
    });
  });

  // Tabs de días
  function activarTab(btn){
    const target = btn.getAttribute('data-target');
    document.querySelectorAll('.day-tab-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('show','active'));
    const pane = document.querySelector(target);
    if (pane){ pane.classList.add('show','active'); }
  }
  document.querySelectorAll('.day-tab-btn').forEach(btn => {
    btn.addEventListener('click', (e) => { e.preventDefault(); activarTab(btn); });
  });
});
</script>
@endsection
