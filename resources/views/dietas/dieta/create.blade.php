@extends('layouts.app')

@section('title', 'Nueva Dieta')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header">
                <h5>Crear Nueva Dieta</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dieta.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="id_usuario" class="form-label">Usuario</label>
                        <select name="id_usuario" class="form-select" required>
                            <option value="">Seleccione un usuario</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('dieta.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
