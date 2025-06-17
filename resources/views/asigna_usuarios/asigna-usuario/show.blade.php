@extends('layouts.app')

@section('title', 'Detalle Asignación')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle de Asignación</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $asignacion->id }}</p>
                <p><strong>Usuario:</strong> {{ $asignacion->id_usuario }}</p>
                <p><strong>Asignación de Grupo:</strong> {{ $asignacion->id_asigna_g }}</p>
                <a href="{{ route('asigna_usuario.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
