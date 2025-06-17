@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Usuarios</h5>
                <a href="{{ route('usuario.create') }}" class="btn btn-primary">+ Nuevo Usuario</a>
            </div>

            <div class="card-body">
                @if (session('flash_message'))
                    <div class="alert alert-success">{{ session('flash_message') }}</div>
                @endif

                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Matrícula</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($usuarios as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->matricula }}</td>
                            <td>
                                <a href="{{ route('usuario.show', $item->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('usuario.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('usuario.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                    {!! $usuarios->appends(['search' => request('search')])->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
