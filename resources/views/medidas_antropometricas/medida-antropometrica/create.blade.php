@extends('layouts.app')

@section('title', 'Nueva Medida Antropométrica')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header"><h5>Registrar Medida Antropométrica</h5></div>
            <div class="card-body">
                <form action="{{ route('medida_antropometrica.store') }}" method="POST">
                    @csrf

                    <div class="mb-3"><label class="form-label">Peso (kg)</label><input type="number" step="0.01" name="peso" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">Talla (m)</label><input type="number" step="0.01" name="talla" class="form-control" required></div>
                    <div class="mb-3"><label class="form-label">IMC</label><input type="number" step="0.01" name="imc" class="form-control"></div>
                    <div class="mb-3"><label class="form-label">Perímetro Abdominal (cm)</label><input type="number" step="0.01" name="perimetro_abdominal" class="form-control"></div>

                    <div class="mb-3">
                        <label class="form-label">Nivel de Peso</label>
                        <select name="id_nivel_p" class="form-select">
                            <option value="">Seleccione un nivel</option>
                            @foreach ($niveles as $n)
                                <option value="{{ $n->id }}">{{ $n->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('medida_antropometrica.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
