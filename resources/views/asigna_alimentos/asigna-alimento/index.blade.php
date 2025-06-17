@extends('layouts.app')

@section('title', 'Asignación de Alimentos')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Listado de Asignaciones de Alimentos</h5>
                <a href="{{ route('asigna-alimento.create') }}" class="btn btn-primary">+ Nueva Asignación</a>
            </div>

            <div class="card-body">
                @if (session('flash_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('flash_message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>ID Comida</th>
                        <th>ID Alimento</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($asignaalimento as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id_comida }}</td>
                            <td>{{ $item->id_alimento }}</td>
                            <td>
                                <a href="{{ route('asigna-alimento.show', $item->id) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('asigna-alimento.edit', $item->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form method="POST" action="{{ route('asigna-alimento.destroy', $item->id) }}" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta asignación?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No hay asignaciones registradas.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
