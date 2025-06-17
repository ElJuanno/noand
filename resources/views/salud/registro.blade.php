@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Registra tus datos de salud</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('salud.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="glucosa" class="form-label">Glucosa (mg/dL)</label>
                <input type="number" step="0.01" name="glucosa" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="condicion" class="form-label">Condición</label>
                <select name="condicion" class="form-select" required>
                    <option value="Ninguna">Ninguna</option>
                    <option value="Diabetes">Diabetes</option>
                    <option value="Otra">Otra</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="peso" class="form-label">Peso (kg)</label>
                <input type="number" step="0.1" name="peso" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="altura" class="form-label">Altura (m)</label>
                <input type="number" step="0.01" name="altura" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" name="edad" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@endsection
