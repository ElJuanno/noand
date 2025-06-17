@extends('layouts.app')

@section('title', 'Editar Asignación')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">Editar Asignación</div>
            <div class="card-body">
                <form method="POST" action="{{ route('asigna-comida.update', $asignacomida->id) }}">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label for="id_dieta" class="form-label">ID Dieta</label>
                        <input type="number" name="id_dieta" value="{{ old('id_dieta') }}">
                    </div>

                    <div class="mb-3">
                        <label for="id_comida" class="form-label">ID Comida</label>
                        <input type="number" name="id_comida" class="form-control" value="{{ old('id_comida', $asignacomida->id_comida) }}" required>
                    </div>

                    <button class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('asigna-comida.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
