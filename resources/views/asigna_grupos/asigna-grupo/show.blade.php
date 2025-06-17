@extends('layouts.app')

@section('title', 'Detalle Asignación')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle de Asignación</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $asignacion->id }}</p>
                <p><strong>Especialista:</strong> {{ $asignacion->id_especialista }}</p>
                <p><strong>Grupo:</strong> {{ $asignacion->id_grupo }}</p>
                <a href="{{ route('asigna_grupo.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
