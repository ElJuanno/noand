@extends('layouts.app')

@section('title', 'Detalle de Asignación')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">Detalle de la Asignación</div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $asignaalimento->id }}</p>
                <p><strong>ID Comida:</strong> {{ $asignaalimento->id_comida }}</p>
                <p><strong>ID Alimento:</strong> {{ $asignaalimento->id_alimento }}</p>

                <a href="{{ route('asigna-alimento.index') }}" class="btn btn-secondary mt-3">← Volver</a>
            </div>
        </div>
    </div>
@endsection
