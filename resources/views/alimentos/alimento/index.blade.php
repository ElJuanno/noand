@extends('layouts.app')

@section('title', 'Alimentos')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Lista de Alimentos</h4>
                <a href="{{ route('alimentos.create') }}" class="btn btn-primary">+ Nuevo Alimento</a>
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
                        <th>Descripción</th>
                        <th>ID Grupo Alimento</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($alimentos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->id_grupo_a }}</td>
                            <td>
                                <a href="{{ route('alimentos.show', $item->id) }}" class="btn btn-sm btn-info">Ver</a>
                                <a href="{{ route('alimentos.edit', $item->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form method="POST" action="{{ route('alimentos.destroy', $item->id) }}" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este alimento?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No hay alimentos registrados.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
