@extends('layouts.app')

@section('title', 'Editar Grupo de Alimento')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Editar Grupo de Alimento</h5></div>
            <div class="card-body">
                <form action="{{ route('grupo_alimento.update', $grupo->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="{{ $grupo->descripcion }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('grupo_alimento.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
