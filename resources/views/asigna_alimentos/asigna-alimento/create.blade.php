@extends('layouts.app')

@section('title', 'Nueva Asignación de Alimento')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">Nueva Asignación</div>
            <div class="card-body">
                <form action="{{ route('asigna-alimento.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="id_comida" class="form-label">ID Comida</label>
                        <input type="number" name="id_comida" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_alimento" class="form-label">ID Alimento</label>
                        <input type="number" name="id_alimento" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('asigna-alimento.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
