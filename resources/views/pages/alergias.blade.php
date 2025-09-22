@extends('layouts.app')
@section('title','Alergias')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<style>
:root{ --brand:#2b8a3e; --bg:#edf7ef; --card:#fff; --line:#e7f0ea; --muted:#6a8b74; --ink:#23452d; }
body{ background:var(--bg)!important; color:var(--ink); }
.wrap{ max-width: 1040px; margin: 24px auto; padding: 0 16px; }
.tile{ background:var(--card); border:1px solid var(--line); border-radius:16px; box-shadow:0 6px 18px rgba(43,138,62,.06); padding:18px }
.hd{ display:flex; justify-content:space-between; align-items:center; gap:8px; flex-wrap:wrap; }
.hd h2{ color:var(--brand); font-weight:900; margin:0 }
.badge-soft{ background:#f3faf5; color:var(--brand); border:1px solid var(--line); border-radius:999px; padding:.35rem .7rem; font-weight:800 }
.helper{ color:var(--muted); margin-top:4px; }

.grid{ display:grid; gap:14px }
@media(min-width:576px){ .grid{ grid-template-columns:repeat(2,1fr) } }
@media(min-width:992px){ .grid{ grid-template-columns:repeat(3,1fr) } }

.item{ position:relative; cursor:pointer; transition:.2s; }
.item input{ display:none; }
.item label{
  display:flex; align-items:center; justify-content:center;
  background:var(--card); border:2px solid var(--line);
  border-radius:14px; padding:16px; width:100%; height:100%;
  font-weight:700; color:var(--ink); text-align:center; cursor:pointer; transition: all .2s;
}
.item input:checked + label{ border-color:var(--brand); background:#f3faf5; color:var(--brand); box-shadow:0 4px 12px rgba(43,138,62,.12); }
.item label:hover{ border-color:var(--brand); background:#f9fdf9; }
</style>
<br>
<div class="wrap">
  <div class="tile mb-3">
    <div class="hd">
      <h2>Alergias</h2>
      <span class="badge-soft"><i class="bi bi-person-badge"></i> {{ $persona->nombre }}</span>
    </div>
    <div class="helper">Marca tus alérgenos. Se aplican automáticamente en Recetas y Plan semanal.</div>
  </div>

  <form action="{{ route('alergias.store') }}" method="POST" class="tile">
    @csrf
    <div class="grid">
      @foreach($alergias as $a)
        <div class="item">
          <input type="checkbox"
                 id="alergia{{ $a->id }}"
                 name="alergias[]"
                 value="{{ $a->id }}"
                 {{ in_array($a->id, $seleccionadas) ? 'checked' : '' }}>
          <label for="alergia{{ $a->id }}">{{ $a->descripcion }}</label>
        </div>
      @endforeach
    </div>

    <button class="btn btn-success mt-4 fw-bold">
      <i class="bi bi-shield-check"></i> Guardar
    </button>

    @if(session('ok'))
      <div class="alert alert-success mt-3">{{ session('ok') }}</div>
    @endif
  </form>
</div>
@endsection
