@extends('layouts.app')

@section('title', 'Nuevo Periodo')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Registrar Nuevo Periodo</h5></div>
            <div class="card-body">
                <form action="{{ route('periodo.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Fecha de Inicio</label>
                        <input type="date" name="fecha_i" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha de Fin</label>
                        <input type="date" name="fecha_f" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('periodo.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
