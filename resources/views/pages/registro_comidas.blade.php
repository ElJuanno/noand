@extends('layouts.app')
@section('title','Registro de Comidas')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<style>
.kpi-card{border-radius:16px;border:1px solid #dff1e6;background:#fff;padding:18px}
.kpi-title{color:#2e7d32;font-weight:800;font-size:.95rem;margin:0}
.kpi-val{font-size:1.4rem;font-weight:800}
.item-card{border-radius:14px;border:1px solid #e7f3ec;background:#fff;padding:14px}
.tag{font-size:.78rem;border-radius:20px;padding:4px 10px;background:#eef8f1;color:#2e7d32;font-weight:700}
</style>
<br><br>
<div class="container py-4" style="max-width:1100px">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <h2 class="fw-bold m-0" style="color:#2e7d32">Registro de Comidas</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAlta">
            <i class="bi bi-plus-circle"></i> Registrar manual
        </button>
    </div>
    <div class="text-muted mb-4">Semana: {{ $start->format('d/m') }} – {{ $end->format('d/m') }}</div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
    @if(session('error'))   <div class="alert alert-danger">{{ session('error') }}</div> @endif

    {{-- KPIs --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4"><div class="kpi-card"><div class="kpi-title">Calorías / semana</div><div class="kpi-val">{{ number_format($sumCal,1) }}</div></div></div>
        <div class="col-md-4"><div class="kpi-card"><div class="kpi-title">Azúcar / semana (g)</div><div class="kpi-val">{{ number_format($sumSugar,1) }}</div></div></div>
        <div class="col-md-4"><div class="kpi-card"><div class="kpi-title">Carbs / semana (g)</div><div class="kpi-val">{{ number_format($sumCarbs,1) }}</div></div></div>
    </div>

    {{-- Gráfica --}}
    <div class="card mb-4" style="border-radius:16px;border:1px solid #dff1e6">
        <div class="card-body">
            <h6 class="mb-3" style="color:#2e7d32;font-weight:800">Tu semana</h6>
            <canvas id="weekChart" height="110"></canvas>
        </div>
    </div>

    {{-- Listado de la semana --}}
    <h6 class="mb-2" style="color:#2e7d32;font-weight:800">Comidas de esta semana</h6>
    <div class="row g-3">
        @forelse($items as $it)
            <div class="col-md-6">
                <div class="item-card d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-bold">{{ $it->nombre }}</div>
                        <div class="text-muted" style="font-size:.9rem">
                            {{ \Carbon\Carbon::parse($it->fecha)->format('d/m') }} · {{ $it->hora ? \Carbon\Carbon::parse($it->hora)->format('H:i') : '—' }}
                            @if($it->tiempo) · <span class="tag">{{ $it->tiempo }}</span>@endif
                        </div>
                        <div class="mt-1" style="font-size:.9rem">
                            <i class="bi bi-fire"></i> {{ $it->calorias }} cal ·
                            <i class="bi bi-droplet"></i> {{ $it->azucar }} g azúcar ·
                            <i class="bi bi-box"></i> {{ $it->carbohidratos }} g carbs
                        </div>
                        @if($it->notas)
                            <div class="text-muted mt-1" style="font-size:.88rem">{{ $it->notas }}</div>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('seguimiento.destroy',$it) }}" onsubmit="return confirm('¿Eliminar este registro?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-12"><div class="alert alert-warning">Aún no has registrado comidas esta semana.</div></div>
        @endforelse
    </div>

    {{-- Historial paginado --}}
    <h6 class="mt-5 mb-2" style="color:#2e7d32;font-weight:800">Historial</h6>
    @foreach($historial as $h)
        <div class="border rounded p-2 mb-2">
            <strong>{{ $h->nombre }}</strong>
            <span class="text-muted">— {{ $h->fecha->format('d/m/Y') }} {{ $h->hora ? \Carbon\Carbon::parse($h->hora)->format('H:i') : '' }}</span>
            <span class="ms-2">{{ $h->calorias }} cal</span>
            @if($h->tiempo)<span class="ms-2 tag">{{ $h->tiempo }}</span>@endif
        </div>
    @endforeach
    {{ $historial->links() }}
</div>

{{-- Modal: alta manual --}}
<div class="modal fade" id="modalAlta" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="{{ route('seguimiento.store') }}">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title">Registrar comida</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required placeholder="Ej. Ensalada de pollo">
            </div>
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="{{ now()->toDateString() }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Hora</label>
                    <input type="time" name="hora" class="form-control" value="{{ now()->format('H:i') }}">
                </div>
            </div>
            <div class="row g-2 mt-0">
                <div class="col-md-6">
                    <label class="form-label">Tiempo</label>
                    <select name="tiempo" class="form-select">
                        <option value="">—</option>
                        <option>Desayuno</option><option>Almuerzo</option>
                        <option>Comida</option><option>Cena</option><option>Snack</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Notas</label>
                    <input type="text" name="notas" class="form-control" placeholder="Opcional">
                </div>
            </div>
            <div class="row g-2 mt-0">
                <div class="col-md-4">
                    <label class="form-label">Calorías</label>
                    <input type="number" step="0.1" min="0" name="calorias" class="form-control" placeholder="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Azúcar (g)</label>
                    <input type="number" step="0.1" min="0" name="azucar" class="form-control" placeholder="0">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Carbs (g)</label>
                    <input type="number" step="0.1" min="0" name="carbohidratos" class="form-control" placeholder="0">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-success">Guardar</button>
        </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('weekChart').getContext('2d'), {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [
            { label: 'Calorías',  data: @json($cals),   tension:.3, borderWidth:2, fill:false },
            { label: 'Azúcar (g)',data: @json($sugars), tension:.3, borderWidth:2, fill:false },
            { label: 'Carbs (g)', data: @json($carbs),  tension:.3, borderWidth:2, fill:false },
        ]
    },
    options: { plugins:{ legend:{ position:'bottom' } }, scales:{ y:{ beginAtZero:true } } }
});
</script>
@endsection
