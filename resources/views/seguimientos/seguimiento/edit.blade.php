@extends('layouts.app')

@section('title', 'Editar Seguimiento')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Editar Seguimiento</h5></div>
            <div class="card-body">
                <form action="{{ route('comida.update', $seguimiento->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Medida Antropométrica</label>
                        <select name="id_medidas_a" class="form-select">
                            @foreach ($medidasAntropometricas as $m)
                                <option value="{{ $m->id }}" {{ $seguimiento->id_medidas_a == $m->id ? 'selected' : '' }}>{{ $m->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Medida de Salud</label>
                        <select name="id_medida_s" class="form-select">
                            @foreach ($medidasSalud as $s)
                                <option value="{{ $s->id }}" {{ $seguimiento->id_medida_s == $s->id ? 'selected' : '' }}>{{ $s->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Periodo</label>
                        <select name="id_periodo" class="form-select">
                            @foreach ($periodos as $p)
                                <option value="{{ $p->id }}" {{ $seguimiento->id_periodo == $p->id ? 'selected' : '' }}>
                                    {{ $p->fecha_i }} al {{ $p->fecha_f }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('comida.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
