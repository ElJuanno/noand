@extends('layouts.app')

@section('title', isset($persona) ? 'Editar Persona' : 'Nueva Persona')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>{{ isset($persona) ? 'Editar Persona' : 'Registrar Persona' }}</h5></div>
            <div class="card-body">
                <form action="{{ isset($persona) ? route('persona.update', $persona->id) : route('persona.store') }}" method="POST">
                    @csrf
                    @if(isset($persona)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $persona->nombre ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellido Paterno</label>
                        <input type="text" name="apellido_p" class="form-control" value="{{ $persona->apellido_p ?? '' }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellido Materno</label>
                        <input type="text" name="apellido_m" class="form-control" value="{{ $persona->apellido_m ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sexo</label>
                        <select name="sexo" class="form-select">
                            <option value="">Seleccione</option>
                            <option value="M" {{ isset($persona) && $persona->sexo == 'M' ? 'selected' : '' }}>M</option>
                            <option value="F" {{ isset($persona) && $persona->sexo == 'F' ? 'selected' : '' }}>F</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">CURP</label>
                        <input type="text" name="curp" class="form-control" value="{{ $persona->curp ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" name="correo" class="form-control" value="{{ $persona->correo ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="text" name="contrasena" class="form-control" value="{{ $persona->contrasena ?? '' }}">
                    </div>

                    <button type="submit" class="btn btn-success">{{ isset($persona) ? 'Actualizar' : 'Guardar' }}</button>
                    <a href="{{ route('persona.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
