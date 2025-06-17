@extends('layouts.app')

@section('title', 'Editar Periodo')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Editar Periodo</h5></div>
            <div class="card-body">
                <form action="{{ route('periodo.update', $periodo->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Fecha de Inicio</label>
                        <input type="date" name="fecha_i" class="form-control" value="{{ $periodo->fecha_i }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha de Fin</label>
                        <input type="date" name="fecha_f" class="form-control" value="{{ $periodo->fecha_f }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('periodo.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
