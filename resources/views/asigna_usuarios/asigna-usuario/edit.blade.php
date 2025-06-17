@extends('layouts.app')

@section('title', 'Editar Asignación')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Editar Asignación</h5></div>
            <div class="card-body">
                <form action="{{ route('asigna_usuario.update', $asignacion->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <select name="id_usuario" class="form-select" required>
                            @foreach ($usuarios as $u)
                                <option value="{{ $u->id }}" {{ $asignacion->id_usuario == $u->id ? 'selected' : '' }}>
                                    {{ $u->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Asignación de Grupo</label>
                        <select name="id_asigna_g" class="form-select" required>
                            @foreach ($asignacionesGrupos as $g)
                                <option value="{{ $g->id }}" {{ $asignacion->id_asigna_g == $g->id ? 'selected' : '' }}>
                                    {{ $g->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('asigna_usuario.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
