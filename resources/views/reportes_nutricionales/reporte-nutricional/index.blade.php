@extends('layouts.app')

@section('title', 'Reportes Nutricionales')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Reportes Nutricionales</h5>
                <a href="{{ route('reporte_nutricional.create') }}" class="btn btn-primary">+ Nuevo Reporte</a>
            </div>

            <div class="card-body">
                @if (session('flash_message'))
                    <div class="alert alert-success">{{ session('flash_message') }}</div>
                @endif

                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Dieta</th>
                        <th>ID Usuario</th>
                        <th>ID Periodo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reportes as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->id_dieta }}</td>
                            <td>{{ $item->id_usuario }}</td>
                            <td>{{ $item->id_periodo }}</td>
                            <td>
                                <a href="{{ route('reporte_nutricional.show', $item->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('reporte_nutricional.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form method="POST" action="{{ route('reporte_nutricional.destroy', $item->id) }}" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5">No hay registros.</td></tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {!! $reportes->appends(['search' => request('search')])->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
