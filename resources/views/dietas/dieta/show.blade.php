@extends('layouts.app')

@section('title', 'Detalle de Dieta')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header">
                <h5>Detalle de Dieta</h5>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $dieta->id }}</p>
                <p><strong>ID Usuario:</strong> {{ $dieta->id_usuario }}</p>

                <a href="{{ route('dieta.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
