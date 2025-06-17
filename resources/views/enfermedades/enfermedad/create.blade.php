@extends('layouts.app')

@section('title', 'Registrar Enfermedad')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Nueva Enfermedad</h5></div>
            <div class="card-body">
                <form action="{{ route('enfermedad.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('enfermedad.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
