@extends('layouts.app')

@section('title', 'Dietas')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Dietas</h5>
                <a href="{{ route('dieta.create') }}" class="btn btn-primary">+ Nueva Dieta</a>
            </div>

            <div class="card-body">
                @if (session('flash_message'))
                    <div class="alert alert-success">{{ session('flash_message') }}</div>
                @endif

                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Usuario</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($dietas as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id_usuario }}</td>
                            <td>
                                <a href="{{ route('dieta.show', $item->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('dieta.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('dieta.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                    {!! $dietas->appends(['search' => request('search')])->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
