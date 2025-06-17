@extends('layouts.app')

@section('title', 'Detalle Nivel de Peso')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle del Nivel de Peso</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $nivel->id }}</p>
                <p><strong>Descripción:</strong> {{ $nivel->descripcion }}</p>
                <a href="{{ route('nivel_peso.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
