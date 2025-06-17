@extends('layouts.app')

@section('title', 'Nueva Asignación')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Asignar Grupo a Especialista</h5></div>
            <div class="card-body">
                <form action="{{ route('asigna_grupo.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Especialista</label>
                        <select name="id_especialista" class="form-select" required>
                            <option value="">Seleccione un especialista</option>
                            @foreach ($especialistas as $e)
                                <option value="{{ $e->id }}">{{ $e->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Grupo</label>
                        <select name="id_grupo" class="form-select" required>
                            <option value="">Seleccione un grupo</option>
                            @foreach ($grupos as $g)
                                <option value="{{ $g->id }}">{{ $g->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('asigna_grupo.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
