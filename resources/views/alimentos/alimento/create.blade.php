@extends('layouts.app')

@section('title', 'Nuevo Alimento')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">Crear nuevo alimento</div>
            <div class="card-body">
                <form action="{{ route('alimentos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_grupo_a" class="form-label">ID Grupo Alimento</label>
                        <input type="number" name="id_grupo_a" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('alimentos.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
