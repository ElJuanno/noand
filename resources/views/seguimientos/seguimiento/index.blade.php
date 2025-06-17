@extends('layouts.app')

@section('title', 'Seguimientos')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Seguimientos</h5>
                <a href="{{ route('comida.create') }}" class="btn btn-primary">+ Nuevo Seguimiento</a>
            </div>

            <div class="card-body">
                @if (session('flash_message'))
                    <div class="alert alert-success">{{ session('flash_message') }}</div>
                @endif

                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Antropometría</th>
                        <th>ID Salud</th>
                        <th>ID Periodo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($seguimientos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id_medidas_a }}</td>
                            <td>{{ $item->id_medida_s }}</td>
                            <td>{{ $item->id_periodo }}</td>
                            <td>
                                <a href="{{ route('comida.show', $item->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('comida.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form method="POST" action="{{ route('comida.destroy', $item->id) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No hay registros.</td></tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {!! $seguimientos->appends(['search' => request('search')])->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
