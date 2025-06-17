@extends('layouts.app')

@section('title', 'Detalle Seguimiento')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle de Seguimiento</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $seguimiento->id }}</p>
                <p><strong>Medida Antropométrica:</strong> {{ $seguimiento->id_medidas_a }}</p>
                <p><strong>Medida de Salud:</strong> {{ $seguimiento->id_medida_s }}</p>
                <p><strong>Periodo:</strong> {{ $seguimiento->id_periodo }}</p>
                <a href="{{ route('comida.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
