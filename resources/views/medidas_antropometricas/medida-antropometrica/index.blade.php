@extends('layouts.app')

@section('title', 'Medidas Antropométricas')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Medidas Antropométricas</h5>
                <a href="{{ route('medida_antropometrica.create') }}" class="btn btn-primary">+ Nueva Medida</a>
            </div>

            <div class="card-body">
                @if (session('flash_message'))
                    <div class="alert alert-success">{{ session('flash_message') }}</div>
                @endif

                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Peso</th>
                        <th>Talla</th>
                        <th>IMC</th>
                        <th>Perímetro Abdominal</th>
                        <th>Nivel</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($medidas as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->peso }}</td>
                            <td>{{ $item->talla }}</td>
                            <td>{{ $item->imc }}</td>
                            <td>{{ $item->perimetro_abdominal }}</td>
                            <td>{{ $item->id_nivel_p }}</td>
                            <td>
                                <a href="{{ route('medida_antropometrica.show', $item->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('medida_antropometrica.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form method="POST" action="{{ route('medida_antropometrica.destroy', $item->id) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7">No hay registros.</td></tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {!! $medidas->appends(['search' => request('search')])->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
