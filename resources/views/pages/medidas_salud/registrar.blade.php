@extends('layouts.app')

@section('title', 'Registrar Medidas de Salud')

@section('content')
<style>
    /* Fondo suave de la página (no tocar el body global de tu layout) */
    .page-bg {
        background: linear-gradient(180deg, #eefaf2 0%, #f7fffb 100%);
        min-height: calc(100vh - 80px);
        padding: 32px 0;
    }

    /* Tarjeta principal */
    .salud-card {
        max-width: 720px;
        margin: 0 auto;
        background: #fff;
        border-radius: 20px;
        border: 1px solid #d9f0e1;
        box-shadow: 0 12px 30px rgba(64, 145, 108, .08);
        overflow: hidden;
    }

    /* Encabezado con icono */
    .salud-header {
        background: linear-gradient(135deg, #43A047, #2e7d32);
        color: #fff;
        padding: 26px 28px;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .salud-header .icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: rgba(255,255,255,.15);
        display: grid;
        place-items: center;
        font-size: 22px;
    }
    .salud-header h4 {
        margin: 0;
        font-weight: 800;
        letter-spacing: .2px;
    }
    .salud-header small {opacity: .9;}

    /* Cuerpo */
    .salud-body {
        padding: 26px 26px 22px;
    }

    /* Inputs */
    .form-control, .form-select {
        border-radius: 12px;
        background-color: #f7fbf8;
        border: 1px solid #d8e9df;
        font-size: .98rem;
        padding: 12px 14px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #43A047;
        box-shadow: 0 0 0 .2rem rgba(67,160,71,.10);
        background: #fff;
    }
    .form-label {
        font-weight: 700;
        color: #2e7d32;
        font-size: .92rem;
        margin-bottom: 6px;
    }
    .hint {
        font-size: .82rem;
        color: #6a8072;
        margin-top: 6px;
    }

    /* Botón */
    .btn-green {
        background-color: #43A047;
        color: #fff;
        border-radius: 12px;
        font-weight: 700;
        padding: 12px 14px;
        transition: transform .04s ease, box-shadow .2s ease, background-color .2s ease;
        border: none;
    }
    .btn-green:hover { background-color: #2e7d32; box-shadow: 0 8px 18px rgba(46,125,50,.18); }
    .btn-green:active { transform: translateY(1px); }

    /* Errores */
    .is-invalid { border-color: #dc3545 !important; background: #fff !important; }
    .invalid-feedback { display: block; font-size: .85rem; }
</style>
<br><br><br>
<div class="page-bg">
    <div class="salud-card">

        {{-- Header --}}
        <div class="salud-header">
            <div class="icon">
                <i class="bi bi-heart-pulse-fill"></i>
            </div>
            <div>
                <h4>Registrar Medidas de Salud</h4>
                <small>Guarda y actualiza tus parámetros principales</small>
            </div>
        </div>

        {{-- Body --}}
        <div class="salud-body">

            {{-- Flash messages --}}
            @if(session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger mb-3">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('medidas.salud.store') }}" novalidate>
                @csrf

                <div class="row g-3">
                    {{-- Glucosa --}}
                    <div class="col-md-6">
                        <label for="glucosa" class="form-label">Glucosa (mg/dL)</label>
                        <input
                            type="number"
                            inputmode="decimal"
                            step="0.1"
                            min="30"
                            max="600"
                            name="glucosa"
                            id="glucosa"
                            class="form-control @error('glucosa') is-invalid @enderror"
                            placeholder="Ej. 95"
                            value="{{ old('glucosa', optional($medidaSalud)->glucosa) }}"
                            required
                        >
                        <div class="hint">Ayunas: típico saludable 70–99 mg/dL</div>
                        @error('glucosa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Edad --}}
                    <div class="col-md-6">
                        <label for="edad" class="form-label">Edad</label>
                        <input
                            type="number"
                            inputmode="numeric"
                            min="1"
                            max="120"
                            name="edad"
                            id="edad"
                            class="form-control @error('edad') is-invalid @enderror"
                            placeholder="Ej. 28"
                            value="{{ old('edad', optional($medidaSalud)->edad) }}"
                            required
                        >
                        @error('edad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Presión arterial --}}
                    <div class="col-md-6">
                        <label for="presion" class="form-label">Presión arterial</label>
                        <input
                            type="text"
                            name="presion"
                            id="presion"
                            class="form-control @error('presion') is-invalid @enderror"
                            placeholder="Ej. 120/80"
                            value="{{ old('presion', optional($medidaSalud)->presion) }}"
                        >
                        <div class="hint">Formato recomendado: <strong>120/80</strong></div>
                        @error('presion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Frecuencia cardiaca --}}
                    <div class="col-md-6">
                        <label for="frecuencia" class="form-label">Frecuencia cardiaca (lpm)</label>
                        <input
                            type="number"
                            inputmode="numeric"
                            min="20"
                            max="220"
                            name="frecuencia"
                            id="frecuencia"
                            class="form-control @error('frecuencia') is-invalid @enderror"
                            placeholder="Ej. 72"
                            value="{{ old('frecuencia', optional($medidaSalud)->frecuencia) }}"
                        >
                        <div class="hint">Latidos por minuto en reposo</div>
                        @error('frecuencia') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Condición --}}
                    <div class="col-12">
                        <label for="condicion" class="form-label">Condición</label>
                        <select
                            name="condicion"
                            id="condicion"
                            class="form-select @error('condicion') is-invalid @enderror"
                            required
                        >
                            <option value="">Selecciona una condición</option>
                            @php
                                $cond = old('condicion', optional($medidaSalud)->condicion);
                            @endphp
                            <option value="ninguna"       {{ $cond === 'ninguna' ? 'selected' : '' }}>Ninguna</option>
                            <option value="diabetes"      {{ $cond === 'diabetes' ? 'selected' : '' }}>Diabetes</option>
                            <option value="hipertensión"  {{ $cond === 'hipertensión' ? 'selected' : '' }}>Hipertensión</option>
                            <option value="obesidad"      {{ $cond === 'obesidad' ? 'selected' : '' }}>Obesidad</option>
                            <option value="dislipidemia"  {{ $cond === 'dislipidemia' ? 'selected' : '' }}>Dislipidemia</option>
                            <option value="enfermedad renal" {{ $cond === 'enfermedad renal' ? 'selected' : '' }}>Enfermedad renal</option>
                            <option value="otro"          {{ $cond === 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('condicion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn-green">
                        <i class="bi bi-check2-circle me-1"></i>
                        Guardar
                    </button>
                </div>

                @if(!empty($medidaSalud?->updated_at))
                    <div class="text-muted text-center mt-3" style="font-size:.85rem;">
                        Última actualización: {{ $medidaSalud->updated_at->format('d/m/Y H:i') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>

{{-- Formateo suave de la presión: convierte "12080" a "120/80" automáticamente --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const presion = document.getElementById('presion');
    if (!presion) return;

    presion.addEventListener('input', () => {
        let v = presion.value.replace(/[^\d/]/g,'').replace(/\/{2,}/g,'/');
        // si escribe 5 o 6 dígitos seguidos sin '/', partimos en 3/2 o 3/3
        if (/^\d{5,6}$/.test(v)) {
            if (v.length === 5) v = v.slice(0,3) + '/' + v.slice(3);
            if (v.length === 6) v = v.slice(0,3) + '/' + v.slice(3);
        }
        presion.value = v;
    });
});
</script>
@endsection
