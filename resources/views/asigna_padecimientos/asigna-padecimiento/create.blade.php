@extends('layouts.app')

@section('title', 'Nueva Asignación de Padecimiento')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Registrar Asignación de Padecimiento</h5></div>
            <div class="card-body">
                <form action="{{ route('asigna_padecimiento.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <select name="id_usuario" class="form-select" required>
                            <option value="">Seleccione un usuario</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Enfermedad</label>
                        <select name="id_enfermedad" class="form-select" required>
                            <option value="">Seleccione una enfermedad</option>
                            @foreach ($enfermedades as $enfermedad)
                                <option value="{{ $enfermedad->id }}">{{ $enfermedad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('asigna_padecimiento.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
