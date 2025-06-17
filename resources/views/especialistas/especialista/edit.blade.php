@extends('layouts.app')

@section('title', 'Editar Especialista')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Editar Especialista</h5></div>
            <div class="card-body">
                <form action="{{ route('especialista.update', $especialista->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Persona</label>
                        <select name="id_persona" class="form-select" required>
                            @foreach ($personas as $persona)
                                <option value="{{ $persona->id }}" {{ $especialista->id_persona == $persona->id ? 'selected' : '' }}>
                                    {{ $persona->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Matrícula</label>
                        <input type="text" name="matricula" class="form-control" value="{{ $especialista->matricula }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Especialidad</label>
                        <select name="id_especialidad" class="form-select">
                            @foreach ($especialidades as $esp)
                                <option value="{{ $esp->id }}" {{ $especialista->id_especialidad == $esp->id ? 'selected' : '' }}>
                                    {{ $esp->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Institución</label>
                        <select name="id_institucion" class="form-select">
                            @foreach ($instituciones as $inst)
                                <option value="{{ $inst->id }}" {{ $especialista->id_institucion == $inst->id ? 'selected' : '' }}>
                                    {{ $inst->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('especialista.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
