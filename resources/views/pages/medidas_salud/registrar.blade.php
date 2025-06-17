@extends('layouts.app')

@section('title', 'Registrar Medidas de Salud')

@section('content')
    <style>
        body {
            background-color: #E8F5E9;
            font-family: 'Inter', sans-serif;
        }

        .salud-card {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            border-radius: 25px;
            padding: 45px 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid #C8E6C9;
        }

        .salud-card h4 {
            color: #2e7d32;
            font-weight: 700;
            font-size: 1.7rem;
        }

        .salud-card p {
            color: #6e8d78;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            background-color: #F1F8F4;
            border: 1px solid #cce3d8;
            font-size: 0.95rem;
        }

        .form-label {
            margin-bottom: 4px;
            font-weight: 600;
            color: #388E3C;
        }

        .btn-green {
            background-color: #43A047;
            color: white;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-green:hover {
            background-color: #2e7d32;
        }

        .alert-success {
            font-size: 0.95rem;
        }
    </style>

    <div class="salud-card text-center">
        <h4>Registrar Medidas de Salud</h4>
        <p>Guarda y actualiza tus parámetros principales</p>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('medidas.salud.store') }}">
            @csrf

            <div class="form-floating mb-3">
                <input type="number" step="0.01" name="glucosa" class="form-control" id="glucosa"
                       value="{{ $medidaSalud ? $medidaSalud->glucosa : '' }}" required>
                <label for="glucosa">Glucosa (mg/dL)</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="presion" class="form-control" id="presion"
                       value="{{ $medidaSalud ? $medidaSalud->presion : '' }}">
                <label for="presion">Presión arterial</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="frecuencia" class="form-control" id="frecuencia"
                       value="{{ $medidaSalud ? $medidaSalud->frecuencia : '' }}">
                <label for="frecuencia">Frecuencia cardiaca</label>
            </div>

            <div class="mb-3 text-start">
                <label for="condicion" class="form-label">Condición</label>
                <select name="condicion" id="condicion" class="form-select" required>
                    <option value="">Selecciona una condición</option>
                    <option value="ninguna" {{ isset($medidaSalud) && $medidaSalud->condicion == 'ninguna' ? 'selected' : '' }}>Ninguna</option>
                    <option value="diabetes" {{ isset($medidaSalud) && $medidaSalud->condicion == 'diabetes' ? 'selected' : '' }}>Diabetes</option>
                    <option value="hipertensión" {{ isset($medidaSalud) && $medidaSalud->condicion == 'hipertensión' ? 'selected' : '' }}>Hipertensión</option>
                    <option value="obesidad" {{ isset($medidaSalud) && $medidaSalud->condicion == 'obesidad' ? 'selected' : '' }}>Obesidad</option>
                    <option value="dislipidemia" {{ isset($medidaSalud) && $medidaSalud->condicion == 'dislipidemia' ? 'selected' : '' }}>Dislipidemia</option>
                    <option value="enfermedad renal" {{ isset($medidaSalud) && $medidaSalud->condicion == 'enfermedad renal' ? 'selected' : '' }}>Enfermedad renal</option>
                    <option value="otro" {{ isset($medidaSalud) && $medidaSalud->condicion == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>

            <div class="form-floating mb-4">
                <input type="number" name="edad" class="form-control" id="edad"
                       value="{{ $medidaSalud ? $medidaSalud->edad : '' }}" required>
                <label for="edad">Edad</label>
            </div>

            <button type="submit" class="btn btn-green w-100">Guardar</button>
        </form>
    </div>
@endsection
