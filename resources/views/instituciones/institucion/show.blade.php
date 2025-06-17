@extends('layouts.app')

@section('title', 'Detalle Institución')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle de Institución</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $institucion->id }}</p>
                <p><strong>Nombre:</strong> {{ $institucion->nombre }}</p>
                <p><strong>Dirección:</strong> {{ $institucion->direccion->descripcion ?? 'N/A' }}</p>
                <a href="{{ route('institucion.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
