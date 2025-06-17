@extends('layouts.app')

@section('title', 'Nueva Especialidad')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Registrar Especialidad</h5></div>
            <div class="card-body">
                <form action="{{ route('especialidad.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('especialidad.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
