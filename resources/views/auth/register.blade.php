@extends('layouts.app')

@section('title', 'Registro')

@section('content')
    <style>
        body {
            background-color: #E8F5E9;
        }

        .register-container {
            max-width: 400px;
            margin: 60px auto;
            background: #fff;
            border-radius: 25px;
            padding: 40px 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .register-logo {
            width: 130px;
            height: 110px;
            margin-bottom: 10px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            background-color: #F1F8F4;
        }

        .btn-green {
            background-color: #388E3C;
            color: white;
            border-radius: 10px;
        }
        .btn-green:hover {
            background-color: #2e7d32;
        }
    </style>

    <div class="register-container text-center">
        <img src="{{ asset('imagenes/logo.png') }}" alt="Logo Dietali" class="register-logo">
        <h4 class="text-success">Crea tu cuenta</h4>
        <p class="text-muted mb-4">Tu app para un estilo de vida saludable</p>
        @if ($errors->any())
            <div class="alert alert-danger text-start">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('registro.personal') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                <label for="nombre">Nombre</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="apellido_p" class="form-control" id="apellido_p" placeholder="Apellido paterno" required>
                <label for="apellido_p">Apellido paterno</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="apellido_m" class="form-control" id="apellido_m" placeholder="Apellido materno" required>
                <label for="apellido_m">Apellido materno</label>
            </div>
            <div class="mb-3 text-start">
                <select name="sexo" class="form-select" required>
                    <option value="">Selecciona Sexo</option>
                    <option value="H">Hombre</option>
                    <option value="M">Mujer</option>
                </select>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="curp" class="form-control" id="curp" placeholder="CURP">
                <label for="curp">CURP (opcional)</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo electrónico" required>
                <label for="correo">Correo electrónico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="contrasena" class="form-control" id="contrasena" placeholder="Contraseña" required>
                <label for="contrasena">Contraseña</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" name="contrasena_confirmation" class="form-control" id="contrasena_confirmation" placeholder="Confirmar contraseña" required>
                <label for="contrasena_confirmation">Confirmar contraseña</label>
            </div>
            <button type="submit" class="btn btn-green w-100">Registrarse</button>
        </form>
        <div class="mt-3">
            <a href="{{ route('login') }}" class="text-success">¿Ya tienes cuenta? Inicia sesión</a>
        </div>
    </div>
@endsection
