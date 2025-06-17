@extends('layouts.app')

@section('title', 'Editar Reporte Nutricional')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Editar Reporte Nutricional</h5></div>
            <div class="card-body">
                <form action="{{ route('reporte_nutricional.update', $reporte->id) }}" method="POST">
                    @csrf @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Dieta</label>
                        <select name="id_dieta" class="form-select">
                            @foreach ($dietas as $d)
                                <option value="{{ $d->id }}" {{ $reporte->id_dieta == $d->id ? 'selected' : '' }}>
                                    {{ $d->descripcion ?? $d->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <select name="id_usuario" class="form-select">
                            @foreach ($usuarios as $u)
                                <option value="{{ $u->id }}" {{ $reporte->id_usuario == $u->id ? 'selected' : '' }}>
                                    {{ $u->nombre ?? $u->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Periodo</label>
                        <select name="id_periodo" class="form-select">
                            @foreach ($periodos as $p)
                                <option value="{{ $p->id }}" {{ $reporte->id_periodo == $p->id ? 'selected' : '' }}>
                                    {{ $p->fecha_i }} al {{ $p->fecha_f }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('reporte_nutricional.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
