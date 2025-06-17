@extends('layouts.app')

@section('title', 'Instituciones')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Instituciones</h5>
                <a href="{{ route('institucion.create') }}" class="btn btn-primary">+ Nueva Institución</a>
            </div>

            <div class="card-body">
                @if (session('flash_message'))
                    <div class="alert alert-success">{{ session('flash_message') }}</div>
                @endif

                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($instituciones as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>
                                <a href="{{ route('institucion.show', $item->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('institucion.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form method="POST" action="{{ route('institucion.destroy', $item->id) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3">No hay registros.</td></tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {!! $instituciones->appends(['search' => request('search')])->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
