@extends('layouts.app')

@section('title', 'Nueva Dirección')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Registrar Dirección</h5></div>
            <div class="card-body">
                <form action="{{ route('direccion.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Código Postal</label>
                        <input type="text" name="cp" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Referencia</label>
                        <textarea name="referencia" class="form-control" rows="2"></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('direccion.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
