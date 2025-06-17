@extends('layouts.app')

@section('title', 'Editar Asignación de Alimento')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">Editar Asignación</div>
            <div class="card-body">
                <form action="{{ route('asigna-alimento.update', $asignaalimento->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="id_comida" class="form-label">ID Comida</label>
                        <input type="number" name="id_comida" class="form-control" value="{{ old('id_comida', $asignaalimento->id_comida) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_alimento" class="form-label">ID Alimento</label>
                        <input type="number" name="id_alimento" class="form-control" value="{{ old('id_alimento', $asignaalimento->id_alimento) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('asigna-alimento.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
