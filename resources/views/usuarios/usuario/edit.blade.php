@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header">
                <h5>Editar Usuario</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Persona</label>
                        <select name="id_persona" class="form-select">
                            <option value="">Seleccione una persona</option>
                            @foreach ($personas as $persona)
                                <option value="{{ $persona->id }}" {{ $usuario->id_persona == $persona->id ? 'selected' : '' }}>
                                    {{ $persona->nombre ?? 'ID ' . $persona->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Matrícula</label>
                        <input type="text" name="matricula" class="form-control" value="{{ $usuario->matricula }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Seguimiento</label>
                        <select name="id_seguimiento" class="form-select">
                            <option value="">Seleccione un seguimiento</option>
                            @foreach ($seguimientos as $item)
                                <option value="{{ $item->id }}" {{ $usuario->id_seguimiento == $item->id ? 'selected' : '' }}>
                                    {{ $item->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Asignación Padecimiento</label>
                        <select name="id_asigna_p" class="form-select">
                            <option value="">Seleccione una asignación</option>
                            @foreach ($asignas as $item)
                                <option value="{{ $item->id }}" {{ $usuario->id_asigna_p == $item->id ? 'selected' : '' }}>
                                    {{ $item->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('usuario.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
