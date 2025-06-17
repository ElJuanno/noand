@extends('layouts.app')

@section('title', 'Detalle de Asignación de Padecimiento')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle de la Asignación</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $asignacion->id }}</p>
                <p><strong>Usuario:</strong> {{ $asignacion->usuario->nombre ?? $asignacion->id_usuario }}</p>
                <p><strong>Enfermedad:</strong> {{ $asignacion->enfermedad->nombre ?? $asignacion->id_enfermedad }}</p>
                <a href="{{ route('asigna_padecimiento.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
