@extends('layouts.app')

@section('title', 'Mi perfil')

@section('content')
    <style>
        body {
            background-color: #E8F5E9;
            font-family: 'Inter', sans-serif;
        }

        .perfil-card {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            border-radius: 25px;
            padding: 45px 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 2px solid #C8E6C9;
            position: relative;
        }

        .perfil-card h4 {
            color: #2e7d32;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .perfil-card p {
            color: #6e8d78;
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            background-color: #F1F8F4;
            border: 1px solid #cce3d8;
            font-size: 0.95rem;
        }

        .form-label {
            margin-bottom: 4px;
            font-weight: 600;
            color: #388E3C;
        }

        .btn-green {
            background-color: #43A047;
            color: white;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            padding: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-green:hover {
            background-color: #2e7d32;
        }

        .foto-preview {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 10px;
            display: block;
            border: 4px solid #4CAF50;
            cursor: pointer;
            transition: transform 0.3s ease, opacity 0.3s ease;
            background-color: #fff;
            box-shadow: 0 0 8px rgba(60, 179, 113, 0.3);
        }

        .foto-preview:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }

        input[type="file"] {
            display: none;
        }

        .text-muted small {
            font-size: 0.87rem;
            color: #888;
        }
    </style>

    <div class="perfil-card text-center">
        <h4>Mi Perfil</h4>
        <p>Consulta y actualiza tu información</p>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        @php
            $foto = $persona->foto ? 'storage/' . $persona->foto : 'imagenes/default-user.png';
        @endphp

        <form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="text-center mb-3">
                <label for="fotoInput">
                    <img src="{{ asset($foto) }}" alt="Foto de perfil" class="foto-preview" id="previewImagen">
                </label>
                <input type="file" name="foto" id="fotoInput" accept="image/*" onchange="previewImagen(this)">
                <small class="text-muted d-block">Haz clic en la imagen para cambiarla</small>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="nombre" class="form-control" id="nombre" value="{{ $persona->nombre }}" required>
                <label for="nombre">Nombre</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="apellido_p" class="form-control" id="apellido_p" value="{{ $persona->apellido_p }}" required>
                <label for="apellido_p">Apellido paterno</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="apellido_m" class="form-control" id="apellido_m" value="{{ $persona->apellido_m }}" required>
                <label for="apellido_m">Apellido materno</label>
            </div>

            <div class="mb-3 text-start">
                <label for="sexo" class="form-label">Sexo</label>
                <select name="sexo" class="form-select" id="sexo" required>
                    <option value="H" {{ $persona->sexo == 'H' ? 'selected' : '' }}>Hombre</option>
                    <option value="M" {{ $persona->sexo == 'M' ? 'selected' : '' }}>Mujer</option>
                </select>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="curp" class="form-control" id="curp" value="{{ $persona->curp }}">
                <label for="curp">CURP (opcional)</label>
            </div>

            <div class="form-floating mb-3">
                <input type="email" name="correo" class="form-control" id="correo" value="{{ $persona->correo }}" required>
                <label for="correo">Correo electrónico</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" step="0.01" name="peso" class="form-control" id="peso"
                       value="{{ $medidaAntro ? $medidaAntro->peso : '' }}" required>
                <label for="peso">Peso (kg)</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" step="0.01" name="altura" class="form-control" id="altura"
                       value="{{ $medidaAntro ? $medidaAntro->altura : '' }}" required>
                <label for="altura">Altura (m)</label>
            </div>

            @if(!is_null($imc))
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" id="imc" value="{{ $imc }}" disabled>
                    <label for="imc">IMC (Índice de Masa Corporal)</label>
                </div>
            @endif

            <button type="submit" class="btn btn-green w-100">
                <i class="bi bi-save-fill me-1"></i> Guardar cambios
            </button>
        </form>
    </div>

    <script>
        function previewImagen(input) {
            const file = input.files[0];
            const preview = document.getElementById('previewImagen');
            if (file) {
                const reader = new FileReader();
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
