@extends('layouts.app')

@section('title', 'Detalle del Alimento')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">Detalle del alimento</div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $alimento->id }}</p>
                <p><strong>Descripción:</strong> {{ $alimento->descripcion }}</p>
                <p><strong>ID Grupo Alimento:</strong> {{ $alimento->id_grupo_a }}</p>

                <a href="{{ route('alimentos.index') }}" class="btn btn-secondary mt-3">← Volver</a>
            </div>
        </div>
    </div>
@endsection
