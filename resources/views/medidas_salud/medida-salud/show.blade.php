@extends('layouts.app')

@section('title', 'Detalle Medida de salud')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle de Medida de Salud</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $medida->id }}</p>
                <p><strong>Descripción:</strong> {{ $medida->descripcion }}</p>
                <a href="{{ route('medida_salud.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
