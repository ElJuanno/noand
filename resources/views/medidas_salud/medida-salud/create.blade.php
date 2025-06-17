@extends('layouts.app')

@section('title', 'Nueva Medida de salud')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Registrar Medida de Salud</h5></div>
            <div class="card-body">
                <form action="{{ route('medida_salud.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('medida_salud.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
