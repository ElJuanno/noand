@extends('layouts.app')

@section('title', 'Editar Asignación')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Editar Asignación</h5></div>
            <div class="card-body">
                <form action="{{ route('asigna_grupo.update', $asignacion->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Especialista</label>
                        <select name="id_especialista" class="form-select" required>
                            @foreach ($especialistas as $e)
                                <option value="{{ $e->id }}" {{ $asignacion->id_especialista == $e->id ? 'selected' : '' }}>
                                    {{ $e->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Grupo</label>
                        <select name="id_grupo" class="form-select" required>
                            @foreach ($grupos as $g)
                                <option value="{{ $g->id }}" {{ $asignacion->id_grupo == $g->id ? 'selected' : '' }}>
                                    {{ $g->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('asigna_grupo.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
