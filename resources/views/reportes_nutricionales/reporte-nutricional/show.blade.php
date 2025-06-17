@extends('layouts.app')

@section('title', 'Detalle Reporte Nutricional')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle del Reporte Nutricional</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $reporte->id }}</p>
                <p><strong>ID Dieta:</strong> {{ $reporte->id_dieta }}</p>
                <p><strong>ID Usuario:</strong> {{ $reporte->id_usuario }}</p>
                <p><strong>ID Periodo:</strong> {{ $reporte->id_periodo }}</p>
                <a href="{{ route('reporte_nutricional.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
