@extends('layouts.app')

@section('title', 'Detalle de Comida')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header">Detalle de Comida</div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $comida->id }}</p>
                <p><strong>Descripción:</strong> {{ $comida->descripcion }}</p>

                <a href="{{ route('comida.index') }}" class="btn btn-secondary mt-3">← Volver</a>
            </div>
        </div>
    </div>
@endsection
