@extends('layouts.app')

@section('title', 'Editar Alergia')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Editar Alergia</h5>
                <a href="{{ route('alergias.index') }}" class="btn btn-secondary btn-sm">← Volver</a>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('alergias.update', $alergia->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" value="{{ old('descripcion', $alergia->descripcion) }}" required>
                        @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
