@extends('layouts.app')

@section('title', 'Detalle de Asignación')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">Detalle de Asignación</div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $asignacomida->id }}</p>
                <p><strong>ID Dieta:</strong> {{ $asignacomida->id_dieta }}</p>
                <p><strong>ID Comida:</strong> {{ $asignacomida->id_comida }}</p>

                <a href="{{ route('asigna-comida.index') }}" class="btn btn-secondary mt-3">← Volver</a>
            </div>
        </div>
    </div>
@endsection
