<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dietali')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #E8F5E9; font-family: 'Segoe UI', sans-serif; }
        .navbar-custom { background-color: #388E3C; }
        .navbar-custom .navbar-brand, .navbar-custom .nav-link, .navbar-custom .nav-item span { color: white; }
        .navbar-custom .nav-link:hover { color: #C8E6C9; }
        .navbar-brand span { font-family: 'Poppins', sans-serif; font-size: 1.5rem; font-weight: 600; letter-spacing: 0.5px; }
        .card { border-radius: 15px; }
        .btn-outline-success { border-color: #388E3C; color: #388E3C; }
        .btn-outline-success:hover { background-color: #388E3C; color: white; }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom px-3 fixed-top ">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('imagenes/logo.png') }}" alt="Logo" style="height: 36px;">
            <span>Dietali</span>
        </a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-3">
                @if(Auth::check())
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link text-white">
                            <i class="fas fa-th-large me-1"></i> Panel
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ strtoupper(Auth::user()->nombre) }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('perfil') }}">Ver perfil</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-white">Iniciar sesión</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link text-white">Registrarse</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="modal fade" id="modalCarga" tabindex="-1" aria-labelledby="modalCargaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4" style="text-align:center;">
            <div>
                <img src="{{ asset('imagenes/gif2.gif') }}" alt="Cargando..." style="width: 70px;">
            </div>
            <h5 class="mt-3" id="modalCargaLabel">Cargando tu plan alimenticio...</h5>
            <div class="progress mt-4" style="height: 22px; background: #C8E6C9; border-radius: 14px;">
                <div id="barraProgreso"
                     class="progress-bar progress-bar-striped progress-bar-animated"
                     role="progressbar"
                     style="width: 10%; background: #388E3C; color: white; font-weight: 600; font-size: 1.08rem; border-radius: 14px;">
                    10%
                </div>
            </div>
            <div class="mt-3" id="mensaje-progreso">
                <span id="consejo-salud">Preparando tus recomendaciones personalizadas. Esto puede tardar unos segundos...</span>
            </div>
        </div>
    </div>
</div>

<main class="py-4">
    @yield('content')
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
<!-- Script del modal de carga -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.getElementById('btn-cargar-plan');
        if (btn) {
            btn.addEventListener('click', function(e) {
                if (btn.getAttribute('href').includes('plan-alimenticio')) {
                    e.preventDefault();
                    let modal = new bootstrap.Modal(document.getElementById('modalCarga'));
                    modal.show();
                    let barra = document.getElementById('barraProgreso');
                    let width = 10;
                    let activo = true;

                    // Progreso dinámico realista, siempre muestra el %
                    let intervalo = setInterval(function(){
                        if(!activo) return;
                        if(width < 70) {
                            width += Math.random() * 7;
                        } else if (width < 90) {
                            width += Math.random() * 2;
                        } else if (width < 97) {
                            width += 0.25;
                        }
                        if(width > 97) width = 97;
                        barra.style.width = width + '%';
                        barra.textContent = Math.floor(width) + '%';
                    }, 140);

                    // Mensajes animados
                    let mensajes = [
                        "Preparando tus recomendaciones personalizadas...",
                        "Analizando tu perfil de salud...",
                        "Buscando recetas saludables para ti...",
                        "Casi listo, ¡esto vale la pena esperar!",
                        "¡Ya merito! Armando tu menú ideal..."
                    ];
                    let consejo = document.getElementById('consejo-salud');
                    let idx = 0;
                    setInterval(function() {
                        idx = (idx + 1) % mensajes.length;
                        consejo.textContent = mensajes[idx];
                    }, 3500);

                    setTimeout(function(){
                        window.location.href = btn.getAttribute('href');
                    }, 600);

                    setTimeout(() => {
                        activo = false;
                        clearInterval(intervalo);
                    }, 60000);
                }
            });
        }

        // --- Al cargar la nueva página, la barra llega a 100% y dice ¡Listo! ---
        let barra = document.getElementById('barraProgreso');
        if (barra) {
            barra.style.width = '100%';
            barra.textContent = '¡Listo!';
            barra.style.background = '#388E3C';
            setTimeout(() => {
                let modalCarga = document.getElementById('modalCarga');
                if (modalCarga) {
                    var modal = bootstrap.Modal.getInstance(modalCarga);
                    if (modal) modal.hide();
                }
            }, 750); // Espera 0.75s para dar feedback visual realista
        }
    });
</script>


</body>
</html>
