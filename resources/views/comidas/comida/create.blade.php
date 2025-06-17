@extends('layouts.app')

@section('title', 'Nueva Comida')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header">Agregar Comida</div>
            <div class="card-body">
                <form method="POST" action="{{ route('comida.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Guardar</button>
                    <a href="{{ route('comida.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
