@extends('layouts.app')

@section('title', 'Detalle Especialista')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle del Especialista</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $especialista->id }}</p>
                <p><strong>Matrícula:</strong> {{ $especialista->matricula }}</p>
                <p><strong>Persona:</strong> {{ $especialista->persona->nombre ?? 'N/A' }}</p>
                <p><strong>Especialidad:</strong> {{ $especialista->especialidad->descripcion ?? 'N/A' }}</p>
                <p><strong>Institución:</strong> {{ $especialista->institucion->nombre ?? 'N/A' }}</p>
                <a href="{{ route('especialista.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
