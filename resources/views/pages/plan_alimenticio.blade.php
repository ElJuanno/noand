@extends('layouts.app')

@section('title', 'Recetas')

@section('content')
@php
    // Orden de secciones
    $ordenTiempos = ['Desayuno', 'Almuerzo', 'Comida', 'Cena', 'Snack'];

    // Limpia arrays tipo c("x","y") o ["x","y"]
    function limpiarIngredientes($ingredientes) {
        if (!$ingredientes) return '';
        if (preg_match('/^c\((.*)\)$/', trim($ingredientes), $m)) {
            $contenido = $m[1];
            $items = preg_split('/",\s*"|\',\s*\'/', trim($contenido, '"\' '));
            return implode(', ', $items);
        }
        return trim(str_replace(['[',']','"',"'" ], '', $ingredientes));
    }
@endphp

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
/* ===== Paleta y base (verde estilo del panel) ===== */
:root{
  --brand: #2b8a3e;
  --brand-2: #3fa55a;
  --bg: #edf7ef;
  --card: #ffffff;
  --text: #23452d;
  --muted:#6a8b74;
  --line:#e7f0ea;
  --ring: rgba(43,138,62,.18);
}
body{ background: var(--bg) !important; color: var(--text); }

/* ===== Contenedor ===== */
.container-narrow{ max-width: 1100px; margin: 0 auto; padding: 24px 16px; }

/* ===== Tarjeta grande de sección ===== */
.tile{
  background: var(--card);
  border: 1px solid var(--line);
  border-radius: 16px;
  box-shadow: 0 6px 18px rgba(43,138,62,.06);
  padding: 20px 18px;
}
.tile-title{ font-weight: 900; color: var(--brand); margin: 0; }
.tile-sub{ color: var(--muted); }

/* ===== Cards de receta ===== */
.card-meal{
  background: var(--card);
  border: 1px solid var(--line);
  border-left: 6px solid var(--brand);
  border-radius: 16px;
  box-shadow: 0 6px 18px rgba(43,138,62,.06);
  height: 100%;
  transition: transform .15s ease, box-shadow .15s ease;
}
.card-meal:hover{ transform: translateY(-3px); box-shadow: 0 10px 20px rgba(43,138,62,.10); }

.card-meal.warn{ border-left-color: #f59e0b; }
.card-meal.danger{ border-left-color: #ef4444; }

.card-hd{ display:flex; align-items:center; justify-content:space-between; gap:.5rem; }
.card-title{ font-weight: 800; color: var(--brand); font-size: 1.05rem; margin: .25rem 0 .35rem; }
.badge-soft{
  background: #f3faf5; color: var(--brand);
  border: 1px solid var(--line);
  padding: .3rem .6rem; border-radius: 999px; font-weight: 700; font-size: .8rem;
}
.meta{ color: var(--muted); font-size: .9rem; display:flex; gap:.6rem; flex-wrap:wrap; }

/* ===== Grids y scroller ===== */
.grid{ display:grid; gap:16px; }
@media (min-width: 576px){ .grid.cols-3{ grid-template-columns: repeat(2, minmax(0,1fr)); } }
@media (min-width: 992px){ .grid.cols-3{ grid-template-columns: repeat(3, minmax(0,1fr)); } }

/* scroller para móviles */
.scroller{
  display:grid; grid-auto-flow: column; grid-auto-columns: minmax(280px, 1fr);
  gap:16px; overflow-x:auto; padding-bottom:4px;
}
.section-head{ display:flex; align-items:center; justify-content:space-between; margin: 16px 0 10px; }
.section-title{ font-weight: 800; color: var(--brand); margin:0; }
.section-sub{ color: var(--muted); font-size:.92rem; }
.empty{
  background: var(--card); border:1px solid var(--line); border-radius:16px;
  padding:18px; text-align:center; color:var(--muted); font-weight:700;
}
</style>
<br><br><p></p>
<div class="container-narrow">

  {{-- Encabezado estilo panel --}}
  <div class="tile mb-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div>
        <h2 class="tile-title">Recetas</h2>
        <div class="tile-sub">Visualiza las recetas que puedes seguir y personalizar.</div>
      </div>
      <div class="d-flex gap-2 flex-wrap">
        @isset($imc)
          <span class="badge-soft"><i class="bi bi-activity"></i> IMC: {{ $imc }}</span>
        @endisset
        @isset($glucosa)
          <span class="badge-soft"><i class="bi bi-droplet-half"></i> Glucosa: {{ $glucosa }}</span>
        @endisset
      </div>
    </div>
  </div>

  {{-- Listas por tiempo (máximo 12 por sección) --}}
  @if(isset($agrupadas) && is_array($agrupadas) && count($agrupadas))
    @foreach($ordenTiempos as $tiempo)
      @php
        $src = $agrupadas[$tiempo] ?? [];
        $lista = is_array($src) ? array_slice($src, 0, 12) : []; // límite 12
      @endphp
      @if(count($lista))
        <div class="section-head">
          <h5 class="section-title">{{ $tiempo }}</h5>
          <div class="section-sub">{{ count($src) }} recetas disponibles • mostrando {{ count($lista) }}</div>
        </div>

        {{-- Grid en pantallas medianas+ --}}
        <div class="d-none d-md-block mb-3">
          <div class="grid cols-3">
            @foreach($lista as $rec)
              @php
                $ing = limpiarIngredientes($rec['ingredientes'] ?? '');
                $class = match($rec['color'] ?? 'verde'){ 'amarillo'=>'warn', 'rojo'=>'danger', default=>'' };
              @endphp
              <article class="card-meal {{ $class }}">
                <div class="p-3">
                  <div class="card-hd">
                    <span class="badge-soft"><i class="bi bi-tags"></i> {{ $rec['categoria'] ?? '—' }}</span>
                  </div>
                  <h6 class="card-title">{{ $rec['nombre'] ?? 'Sin nombre' }}</h6>
                  <div class="section-sub"><i class="bi bi-list-ul"></i> {{ \Illuminate\Support\Str::limit($ing, 140) }}</div>
                  <div class="meta mt-2">
                    <span><i class="bi bi-fire"></i> {{ $rec['calorias'] ?? 'N/A' }} cal</span>
                    <span><i class="bi bi-droplet"></i> {{ $rec['azucar'] ?? 'N/A' }} azúcar</span>
                    <span><i class="bi bi-box"></i> {{ $rec['carbohidratos'] ?? 'N/A' }} carbs</span>
                  </div>

                  {{-- Seguir -> Seguimiento --}}
                  <form action="{{ route('seguimiento.store') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="nombre"        value="{{ $rec['nombre'] ?? '' }}">
                    <input type="hidden" name="tiempo"        value="{{ $tiempo }}">
                    <input type="hidden" name="fecha"         value="{{ now()->toDateString() }}">
                    <input type="hidden" name="hora"          value="{{ now()->format('H:i:s') }}">
                    <input type="hidden" name="calorias"      value="{{ $rec['calorias'] ?? 0 }}">
                    <input type="hidden" name="azucar"        value="{{ $rec['azucar'] ?? 0 }}">
                    <input type="hidden" name="carbohidratos" value="{{ $rec['carbohidratos'] ?? 0 }}">
                    <button type="submit" class="btn btn-success btn-sm w-100">Seguir</button>
                  </form>
                </div>
              </article>
            @endforeach
          </div>
        </div>

        {{-- Scroller en móviles --}}
        <div class="d-md-none mb-3">
          <div class="scroller">
            @foreach($lista as $rec)
              @php
                $ing = limpiarIngredientes($rec['ingredientes'] ?? '');
                $class = match($rec['color'] ?? 'verde'){ 'amarillo'=>'warn', 'rojo'=>'danger', default=>'' };
              @endphp
              <article class="card-meal {{ $class }}" style="min-width: 85vw;">
                <div class="p-3">
                  <div class="card-hd">
                    <span class="badge-soft"><i class="bi bi-tags"></i> {{ $rec['categoria'] ?? '—' }}</span>
                  </div>
                  <h6 class="card-title">{{ \Illuminate\Support\Str::limit($rec['nombre'] ?? 'Sin nombre', 50) }}</h6>
                  <div class="section-sub"><i class="bi bi-list-ul"></i> {{ \Illuminate\Support\Str::limit($ing, 120) }}</div>
                  <div class="meta mt-2">
                    <span><i class="bi bi-fire"></i> {{ $rec['calorias'] ?? 'N/A' }}</span>
                    <span><i class="bi bi-droplet"></i> {{ $rec['azucar'] ?? 'N/A' }}</span>
                    <span><i class="bi bi-box"></i> {{ $rec['carbohidratos'] ?? 'N/A' }}</span>
                  </div>

                  {{-- Seguir -> Seguimiento (móvil) --}}
                  <form action="{{ route('seguimiento.store') }}" method="POST" class="mt-2">
                    @csrf
                    <input type="hidden" name="nombre"        value="{{ $rec['nombre'] ?? '' }}">
                    <input type="hidden" name="tiempo"        value="{{ $tiempo }}">
                    <input type="hidden" name="fecha"         value="{{ now()->toDateString() }}">
                    <input type="hidden" name="hora"          value="{{ now()->format('H:i:s') }}">
                    <input type="hidden" name="calorias"      value="{{ $rec['calorias'] ?? 0 }}">
                    <input type="hidden" name="azucar"        value="{{ $rec['azucar'] ?? 0 }}">
                    <input type="hidden" name="carbohidratos" value="{{ $rec['carbohidratos'] ?? 0 }}">
                    <button class="btn btn-success w-100 fw-semibold">Seguir</button>
                  </form>
                </div>
              </article>
            @endforeach
          </div>
        </div>
      @endif
    @endforeach
  @else
    <div class="empty">No se encontraron recetas para tus parámetros actuales.</div>
  @endif
</div>
@endsection
