@extends('layouts.app')

@section('title', 'Grupos de Alimentos')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Grupos de Alimentos</h5>
                <a href="{{ route('grupo_alimento.create') }}" class="btn btn-primary">+ Nuevo Grupo</a>
            </div>
            <div class="card-body">
                @if (session('flash_message'))
                    <div class="alert alert-success">{{ session('flash_message') }}</div>
                @endif

                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($grupos as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>
                                <a href="{{ route('grupo_alimento.show', $item->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('grupo_alimento.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('grupo_alimento.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3">No hay grupos registrados.</td></tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {!! $grupos->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
