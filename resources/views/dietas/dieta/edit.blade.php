@extends('layouts.app')

@section('title', 'Editar Dieta')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header">
                <h5>Editar Dieta</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dieta.update', $dieta->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label for="id_usuario" class="form-label">Usuario</label>
                        <select name="id_usuario" class="form-select" required>
                            <option value="">Seleccione un usuario</option>
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $dieta->id_usuario == $usuario->id ? 'selected' : '' }}>{{ $usuario->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('dieta.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
