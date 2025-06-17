@extends('layouts.app')

@section('title', 'Detalle de Grupo de Alimento')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $grupo->id }}</p>
                <p><strong>Descripción:</strong> {{ $grupo->descripcion }}</p>
                <a href="{{ route('grupo_alimento.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
