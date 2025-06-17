@extends('layouts.app')

@section('title', 'Nuevo Reporte Nutricional')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Registrar Reporte Nutricional</h5></div>
            <div class="card-body">
                <form action="{{ route('reporte_nutricional.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Dieta</label>
                        <select name="id_dieta" class="form-select">
                            <option value="">Seleccione una dieta</option>
                            @foreach ($dietas as $d)
                                <option value="{{ $d->id }}">{{ $d->descripcion ?? $d->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <select name="id_usuario" class="form-select">
                            <option value="">Seleccione un usuario</option>
                            @foreach ($usuarios as $u)
                                <option value="{{ $u->id }}">{{ $u->nombre ?? $u->id }}</option>
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
                    <a href="{{ route('reporte_nutricional.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
