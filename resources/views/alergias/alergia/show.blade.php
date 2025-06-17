@extends('layouts.app')

@section('title', 'Detalle de Alergia')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Detalle de Alergia</h5>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $alergia->id }}</p>
                <p><strong>Descripción:</strong> {{ $alergia->descripcion }}</p>

                <a href="{{ route('alergias.index') }}" class="btn btn-secondary mt-3">← Volver a la lista</a>
            </div>
        </div>
    </div>
@endsection
