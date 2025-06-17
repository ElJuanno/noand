@extends('layouts.app')

@section('title', 'Nuevo Seguimiento')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Registrar Seguimiento</h5></div>
            <div class="card-body">
                <form action="{{ route('comida.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Medida Antropométrica</label>
                        <select name="id_medidas_a" class="form-select">
                            <option value="">Seleccione una medida</option>
                            @foreach ($medidasAntropometricas as $m)
                                <option value="{{ $m->id }}">{{ $m->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Medida de Salud</label>
                        <select name="id_medida_s" class="form-select">
                            <option value="">Seleccione una medida</option>
                            @foreach ($medidasSalud as $s)
                                <option value="{{ $s->id }}">{{ $s->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Periodo</label>
                        <select name="id_periodo" class="form-select">
                            <option value="">Seleccione un periodo</option>
                            @foreach ($periodos as $p)
                                <option value="{{ $p->id }}">{{ $p->fecha_i }} al {{ $p->fecha_f }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('comida.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
