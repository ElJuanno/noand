@extends('layouts.app')

@section('title', 'Periodos')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Periodos</h5>
                <a href="{{ route('periodo.create') }}" class="btn btn-primary">+ Nuevo Periodo</a>
            </div>

            <div class="card-body">
                @if (session('flash_message'))
                    <div class="alert alert-success">{{ session('flash_message') }}</div>
                @endif

                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($periodos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->fecha_i }}</td>
                            <td>{{ $item->fecha_f }}</td>
                            <td>
                                <a href="{{ route('periodo.show', $item->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('periodo.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form method="POST" action="{{ route('periodo.destroy', $item->id) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No hay registros.</td></tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {!! $periodos->appends(['search' => request('search')])->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
