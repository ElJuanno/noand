@extends('layouts.app')

@section('title', 'Direcciones')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Direcciones</h5>
                <a href="{{ route('direccion.create') }}" class="btn btn-primary">+ Nueva Dirección</a>
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
                        <th>C.P.</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($direcciones as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->cp }}</td>
                            <td>
                                <a href="{{ route('direccion.show', $item->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('direccion.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form method="POST" action="{{ route('direccion.destroy', $item->id) }}" style="display:inline;">
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
                    {!! $direcciones->appends(['search' => request('search')])->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
