@extends('layouts.app')

@section('title', 'Alergias')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Lista de Alergias</h4>
                <a href="{{ route('alergias.create') }}" class="btn btn-primary">+ Nueva Alergia</a>
            </div>

            <div class="card-body">
                @if (session()->has('flash_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('flash_message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($alergia as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>
                                <a href="{{ route('alergias.show', $item->id) }}" class="btn btn-sm btn-outline-info" title="Ver">
                                    <i class="bi bi-eye"></i> Ver
                                </a>
                                <a href="{{ route('alergias.edit', $item->id) }}" class="btn btn-sm btn-outline-warning" title="Editar">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="{{ route('alergias.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar esta alergia?')" title="Eliminar">
                                        <i class="bi bi-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No hay alergias registradas.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-3">
                    {!! $alergia->appends(['search' => Request::get('search')])->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
