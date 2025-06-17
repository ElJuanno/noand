@extends('layouts.app')

@section('title', 'Detalle Especialidad')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle de Especialidad</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $especialidad->id }}</p>
                <p><strong>Descripción:</strong> {{ $especialidad->descripcion }}</p>
                <a href="{{ route('especialidad.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
