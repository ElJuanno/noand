@extends('layouts.app')

@section('title', 'Editar Asignación de Padecimiento')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Editar Asignación</h5></div>
            <div class="card-body">
                <form action="{{ route('asigna_padecimiento.update', $asignacion->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <select name="id_usuario" class="form-select" required>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $asignacion->id_usuario == $usuario->id ? 'selected' : '' }}>
                                    {{ $usuario->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Enfermedad</label>
                        <select name="id_enfermedad" class="form-select" required>
                            @foreach ($enfermedades as $enfermedad)
                                <option value="{{ $enfermedad->id }}" {{ $asignacion->id_enfermedad == $enfermedad->id ? 'selected' : '' }}>
                                    {{ $enfermedad->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('asigna_padecimiento.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
