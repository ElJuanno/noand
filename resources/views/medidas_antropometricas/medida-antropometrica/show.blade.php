@extends('layouts.app')

@section('title', 'Detalle Medida Antropométrica')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle de Medida Antropométrica</h5></div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $medida->id }}</p>
                <p><strong>Peso:</strong> {{ $medida->peso }} kg</p>
                <p><strong>Talla:</strong> {{ $medida->talla }} m</p>
                <p><strong>IMC:</strong> {{ $medida->imc }}</p>
                <p><strong>Perímetro Abdominal:</strong> {{ $medida->perimetro_abdominal }} cm</p>
                <p><strong>Nivel de Peso:</strong> {{ $medida->id_nivel_p }}</p>
                <a href="{{ route('medida_antropometrica.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
