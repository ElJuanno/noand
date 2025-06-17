@extends('layouts.app')

@section('title', 'Detalle Persona')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Detalle de Persona</h5></div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $persona->nombre }} {{ $persona->apellido_p }} {{ $persona->apellido_m }}</p>
                <p><strong>Sexo:</strong> {{ $persona->sexo }}</p>
                <p><strong>CURP:</strong> {{ $persona->curp }}</p>
                <p><strong>Correo:</strong> {{ $persona->correo }}</p>
                <a href="{{ route('persona.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
