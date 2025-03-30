@extends('layouts.app')

@section('template_title')
    {{ $persona->name ?? __('Show') . " " . __('Persona') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Persona</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('personas.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Persona:</strong>
                                    {{ $persona->id_persona }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre:</strong>
                                    {{ $persona->nombre }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellido P:</strong>
                                    {{ $persona->apellido_p }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Apellido M:</strong>
                                    {{ $persona->apellido_m }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Sexo:</strong>
                                    {{ $persona->sexo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Curp:</strong>
                                    {{ $persona->curp }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Correo:</strong>
                                    {{ $persona->correo }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Contraseña:</strong>
                                    {{ $persona->contraseña }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
