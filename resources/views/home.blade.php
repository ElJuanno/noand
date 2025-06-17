@extends('layouts.app')

@section('title', 'Bienvenido a Dietali')

@section('content')
    <style>
        body { background-color: #F1F8F4; font-family: 'Poppins', sans-serif; }

        .carousel img {
            height: 100%;
            object-fit: cover;
        }

        .feature-icon {
            font-size: 3rem;
            color: #43A047;
            margin-bottom: 15px;
        }

        .feature-card {
            background: white;
            padding: 25px 20px;
            border-radius: 16px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 18px rgba(56, 142, 60, 0.15);
        }

        .footer-home {
            background-color: #388E3C;
            color: white;
            padding: 40px 20px;
            border-radius: 20px;
            margin-top: 60px;
            text-align: center;
        }

        .footer-home h5 {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .footer-home a {
            color: #C8E6C9;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-home a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="container mt-5">
        <!-- Hero con fondo carrusel -->
        <div class="position-relative mb-5" style="height: 480px; border-radius: 20px; overflow: hidden;">
            <!-- Carrusel como fondo -->
            <div id="carouselHero" class="carousel slide h-100 w-100 position-absolute" data-bs-ride="carousel">
                <div class="carousel-inner h-100 w-100">
                    <div class="carousel-item active h-100">
                        <img src="{{ asset('imagenes/slide1.jpg') }}" class="d-block w-100 h-100" alt="Fondo 1">
                    </div>
                    <div class="carousel-item h-100">
                        <img src="{{ asset('imagenes/slide2.jpg') }}" class="d-block w-100 h-100" alt="Fondo 2">
                    </div>
                    <div class="carousel-item h-100">
                        <img src="{{ asset('imagenes/slide3.jpg') }}" class="d-block w-100 h-100" alt="Fondo 3">
                    </div>
                </div>
            </div>

            <!-- Capa de oscurecimiento -->
            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>

            <!-- Contenido centrado -->
            <div class="position-relative z-2 h-100 d-flex flex-column justify-content-center align-items-center text-center text-white px-3">
                <img src="{{ asset('imagenes/logo.png') }}" alt="Logo Dietali" style="width: 90px;" class="mb-3">
                <h1 class="fw-bold display-5">Bienvenido a Dietali</h1>
                <p class="lead mb-3">Tu aliado para un estilo de vida saludable y personalizado</p>

                @auth
                    <p class="mb-3">Hola, <strong>{{ Auth::user()->nombre ?? 'usuario' }}</strong> 👋</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg rounded-pill px-4">Ir al panel</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg rounded-pill px-4">Comienza ahora</a>
                @endauth
            </div>
        </div>

        <!-- ¿Quiénes somos? -->
        <div class="mb-5 text-center">
            <h2 class="text-success mb-3">¿Quiénes somos?</h2>
            <p class="lead mx-auto" style="max-width: 720px;">
                En <strong>Dietali</strong> creemos que una alimentación balanceada es la base para una vida plena y saludable. Nuestra plataforma te ayuda a crear <strong>planes alimenticios personalizados</strong> basados en tu salud, hábitos y preferencias.
            </p>
        </div>

        <!-- Características -->
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-card h-100">
                    <div class="feature-icon"><i class="fas fa-utensils"></i></div>
                    <h4 class="text-success">Planes Personalizados</h4>
                    <p>Recibe un plan alimenticio adaptado a tus necesidades y objetivos.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card h-100">
                    <div class="feature-icon"><i class="fas fa-heartbeat"></i></div>
                    <h4 class="text-success">Seguimiento de Salud</h4>
                    <p>Monitorea tu glucosa, peso y otros indicadores clave.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-card h-100">
                    <div class="feature-icon"><i class="fas fa-mobile-alt"></i></div>
                    <h4 class="text-success">Fácil de Usar</h4>
                    <p>Accede desde cualquier dispositivo y controla tu alimentación en cualquier momento.</p>
                </div>
            </div>
        </div>

        <!-- Footer solo para home -->
        <div class="footer-home mt-5">
            <h5>Conócenos en nuestras redes</h5>
            <p>Síguenos para más tips saludables, recetas y novedades.</p>
            <div class="d-flex justify-content-center gap-4 fs-4">
                <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
@endsection
