@extends('layouts.app')

@section('title', 'Detalle Periodo')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle del Periodo</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $periodo->id }}</p>
                <p><strong>Fecha de Inicio:</strong> {{ $periodo->fecha_i }}</p>
                <p><strong>Fecha de Fin:</strong> {{ $periodo->fecha_f }}</p>
                <a href="{{ route('periodo.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
