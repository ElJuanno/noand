@extends('layouts.app')

@section('title', 'Asignaciones de Comidas')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Listado de Asignaciones de Comidas</h5>
                <a href="{{ route('asigna-comida.create') }}" class="btn btn-primary">+ Nueva Asignación</a>
            </div>

            <div class="card-body">
                @if (session('flash_message'))
                    <div class="alert alert-success">{{ session('flash_message') }}</div>
                @endif

                <table class="table table-hover table-bordered text-center">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>ID Dieta</th>
                        <th>ID Comida</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($asignacomida as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id_dieta }}</td>
                            <td>{{ $item->id_comida }}</td>
                            <td>
                                <a href="{{ route('asigna-comida.show', $item->id) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('asigna-comida.edit', $item->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form method="POST" action="{{ route('asigna-comida.destroy', $item->id) }}" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if ($asignacomida->isEmpty())
                        <tr><td colspan="4">No hay registros aún.</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
