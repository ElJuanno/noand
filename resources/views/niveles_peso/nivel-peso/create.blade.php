@extends('layouts.app')

@section('title', 'Nuevo Nivel de Peso')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Registrar Nivel de Peso</h5></div>
            <div class="card-body">
                <form action="{{ route('nivel_peso.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('nivel_peso.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
