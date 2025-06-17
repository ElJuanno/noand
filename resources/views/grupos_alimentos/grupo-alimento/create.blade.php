@extends('layouts.app')

@section('title', 'Registrar Grupo de Alimento')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Nuevo Grupo de Alimento</h5></div>
            <div class="card-body">
                <form action="{{ route('grupo_alimento.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('grupo_alimento.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
