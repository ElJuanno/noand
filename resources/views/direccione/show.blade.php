@extends('layouts.app')

@section('template_title')
    {{ $direccione->name ?? __('Show') . " " . __('Direccione') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Direccione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('direcciones.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Direccion:</strong>
                                    {{ $direccione->id_direccion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Descripcion:</strong>
                                    {{ $direccione->descripcion }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Cp:</strong>
                                    {{ $direccione->cp }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Referencia:</strong>
                                    {{ $direccione->referencia }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
