@extends('layouts.app')

@section('title', 'Detalle de Enfermedad')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalles</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $enfermedad->id }}</p>
                <p><strong>Nombre:</strong> {{ $enfermedad->nombre }}</p>
                <a href="{{ route('enfermedad.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
