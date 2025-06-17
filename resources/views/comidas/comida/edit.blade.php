@extends('layouts.app')

@section('title', 'Editar Comida')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header">Editar Comida</div>
            <div class="card-body">
                <form method="POST" action="{{ route('comida.update', $comida->id) }}">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" value="{{ old('descripcion', $comida->descripcion) }}" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('comida.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
