@extends('layouts.app')

@section('title', 'Detalle Dirección')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle de Dirección</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $direccion->id }}</p>
                <p><strong>Descripción:</strong> {{ $direccion->descripcion }}</p>
                <p><strong>Código Postal:</strong> {{ $direccion->cp }}</p>
                <p><strong>Referencia:</strong> {{ $direccion->referencia }}</p>
                <a href="{{ route('direccion.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
