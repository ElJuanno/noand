@extends('layouts.app')

@section('title', 'Enfermedades')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Enfermedades</h5>
                <a href="{{ route('enfermedad.create') }}" class="btn btn-primary">+ Nueva Enfermedad</a>
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
                    @forelse($enfermedades as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td>
                                <a href="{{ route('enfermedad.show', $item->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('enfermedad.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('enfermedad.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3">No hay enfermedades registradas.</td></tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {!! $enfermedades->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
