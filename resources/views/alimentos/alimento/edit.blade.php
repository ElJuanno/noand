@extends('layouts.app')

@section('title', 'Editar Alimento')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">Editar alimento</div>
            <div class="card-body">
                <form action="{{ route('alimentos.update', $alimento->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $alimento->descripcion) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_grupo_a" class="form-label">ID Grupo Alimento</label>
                        <input type="number" name="id_grupo_a" class="form-control" value="{{ old('id_grupo_a', $alimento->id_grupo_a) }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('alimentos.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
