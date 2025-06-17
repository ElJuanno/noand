@extends('layouts.app')

@section('title', 'Nueva Asignación')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Asignar Usuario a Grupo</h5></div>
            <div class="card-body">
                <form action="{{ route('asigna_usuario.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <select name="id_usuario" class="form-select" required>
                            <option value="">Seleccione un usuario</option>
                            @foreach ($usuarios as $u)
                                <option value="{{ $u->id }}">{{ $u->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Asignación de Grupo</label>
                        <select name="id_asigna_g" class="form-select" required>
                            <option value="">Seleccione una asignación</option>
                            @foreach ($asignacionesGrupos as $g)
                                <option value="{{ $g->id }}">{{ $g->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('asigna_usuario.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
