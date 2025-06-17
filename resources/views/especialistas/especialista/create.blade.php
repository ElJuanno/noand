@extends('layouts.app')

@section('title', 'Nuevo Especialista')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Registrar Especialista</h5></div>
            <div class="card-body">
                <form action="{{ route('especialista.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Persona</label>
                        <select name="id_persona" class="form-select" required>
                            <option value="">Seleccione una persona</option>
                            @foreach ($personas as $persona)
                                <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Matrícula</label>
                        <input type="text" name="matricula" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Especialidad</label>
                        <select name="id_especialidad" class="form-select">
                            <option value="">Seleccione una especialidad</option>
                            @foreach ($especialidades as $esp)
                                <option value="{{ $esp->id }}">{{ $esp->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Institución</label>
                        <select name="id_institucion" class="form-select">
                            <option value="">Seleccione una institución</option>
                            @foreach ($instituciones as $inst)
                                <option value="{{ $inst->id }}">{{ $inst->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('especialista.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
