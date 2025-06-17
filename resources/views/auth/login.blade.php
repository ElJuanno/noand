@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
    <style>
        body {
            background-color: #E8F5E9;
        }

        .login-container {
            max-width: 400px;
            margin: 60px auto;
            background: #fff;
            border-radius: 25px;
            padding: 40px 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .login-logo {
            width: 130px;
            height: 110px;
            margin-bottom: 10px;
        }

        .form-control {
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

    <div class="login-container text-center">
        <img src="{{ asset('imagenes/logo.png') }}" alt="Logo Dietali" class="login-logo">

        <h4 class="text-success">Iniciar sesión</h4>
        <p class="text-muted mb-4">Tu app para un estilo de vida saludable</p>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.personal') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" name="correo" class="form-control" id="correo" placeholder="ejemplo@correo.com" required>
                <label for="correo">Correo electrónico</label>
            </div>
            <div class="form-floating mb-4">
                <input type="password" name="contrasena" class="form-control" id="contrasena" placeholder="Contraseña" required>
                <label for="contrasena">Contraseña</label>
            </div>
            <button type="submit" class="btn btn-green w-100">Entrar</button>
        </form>

        <div class="mt-3">
            <a href="{{ route('register') }}" class="text-success">¿No tienes cuenta? Regístrate aquí</a>
        </div>
    </div>
@endsection
