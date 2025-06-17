@extends('layouts.app')

@section('title', 'Editar Institución')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Editar Institución</h5></div>
            <div class="card-body">
                <form action="{{ route('institucion.update', $institucion->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="{{ $institucion->nombre }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <select name="id_direccion" class="form-select">
                            @foreach ($direcciones as $dir)
                                <option value="{{ $dir->id }}" {{ $institucion->id_direccion == $dir->id ? 'selected' : '' }}>
                                    {{ $dir->descripcion }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('institucion.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
