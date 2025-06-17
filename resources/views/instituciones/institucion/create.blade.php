@extends('layouts.app')

@section('title', 'Nueva Institución')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Registrar Institución</h5></div>
            <div class="card-body">
                <form action="{{ route('institucion.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <select name="id_direccion" class="form-select">
                            <option value="">Seleccione una dirección</option>
                            @foreach ($direcciones as $dir)
                                <option value="{{ $dir->id }}">{{ $dir->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('institucion.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
