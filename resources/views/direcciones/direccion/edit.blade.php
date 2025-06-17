@extends('layouts.app')

@section('title', 'Editar Dirección')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Editar Dirección</h5></div>
            <div class="card-body">
                <form action="{{ route('direccion.update', $direccion->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="{{ $direccion->descripcion }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Código Postal</label>
                        <input type="text" name="cp" class="form-control" value="{{ $direccion->cp }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Referencia</label>
                        <textarea name="referencia" class="form-control" rows="2">{{ $direccion->referencia }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('direccion.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
