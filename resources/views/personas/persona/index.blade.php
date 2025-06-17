@extends('layouts.app')

@section('title', 'Personas')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <h5>Listado de Personas</h5>
                <a href="{{ route('persona.create') }}" class="btn btn-primary">+ Nueva Persona</a>
            </div>

            <div class="card-body">
                @if (session('flash_message'))
                    <div class="alert alert-success">{{ session('flash_message') }}</div>
                @endif

                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre completo</th>
                        <th>Sexo</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($personas as $persona)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $persona->nombre }} {{ $persona->apellido_p }} {{ $persona->apellido_m }}</td>
                            <td>{{ $persona->sexo }}</td>
                            <td>{{ $persona->correo }}</td>
                            <td>
                                <a href="{{ route('persona.show', $persona->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('persona.edit', $persona->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form method="POST" action="{{ route('persona.destroy', $persona->id) }}" style="display:inline;">
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
                    {!! $personas->appends(['search' => request('search')])->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
