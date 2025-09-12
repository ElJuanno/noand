@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        .dashboard {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .dashboard h2 {
            font-weight: 700;
            color: #388E3C;
        }
        .card-custom {
            border-radius: 20px;
            background-color: #fff;
            box-shadow: 0 4px 14px 0 rgba(56, 142, 60, .07);
            transition: transform 0.2s;
            min-height: 190px;
        }
        .card-custom:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 8px 20px 0 rgba(56, 142, 60, .13);
        }
        .card-body i {
            font-size: 2.2rem;
            color: #388E3C;
            margin-bottom: 10px;
        }
        .card-title {
            color: #2e7d32;
            font-weight: 600;
        }
        .consejo {
            font-size: 1.08rem;
            color: #616161;
            margin-top: 8px;
        }
    </style>

    <div class="dashboard">
        <br>
        <h2 class="mb-4 text-center">!!Bienvenido, {{ Auth::user()->nombre }}¡¡</h2>


        <div class="row g-4">
            <!-- Plan Alimenticio -->
            <div class="col-12 col-md-12">
                <div class="card card-custom h-100 p-2">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                        <i class="fas fa-utensils"></i>
                        <h5 class="card-title mt-2">Plan Alimenticio</h5>
                        <p class="text-muted mb-2">Visualiza y sigue tu plan alimenticio personalizado.</p>
                        <a href="{{ route('planes.alimenticio') }}" class="btn btn-outline-success" id="btn-cargar-plan">
                            Ver plan alimenticio
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-custom h-100 p-2">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                        <i class="fas fa-utensils"></i>
                        <h5 class="card-title mt-2">Recetas</h5>
                        <p class="text-muted mb-2">Visualiza las recetas que puedes seguir y personalizar</p>
                        <a href="{{ route('plan.alimenticio') }}" class="btn btn-outline-success" id="btn-cargar-plan">
                            Ver recetas
                        </a>
                    </div>
                </div>
            </div>

            <!-- Registro de Glucosa -->
            <div class="col-12 col-md-4">
                <div class="card card-custom h-100 p-2">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                        <i class="fas fa-tint"></i>
                        <h5 class="card-title mt-2">Registro de Glucosa</h5>
                        <p class="text-muted mb-2">Registra y consulta tus niveles de glucosa.</p>
                        <a href="{{ route('medidas.salud.create') }}" class="btn btn-outline-success">Registrar</a>

                    </div>
                </div>
            </div>
            <!-- Alergias -->
            <div class="col-12 col-md-4">
                <div class="card card-custom h-100 p-2">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                        <i class="fas fa-allergies"></i>
                        <h5 class="card-title mt-2">Alergias</h5>
                        <p class="text-muted mb-2">Administra tus alergias alimentarias para un plan más seguro.</p>
                        <a href="{{ route('alergias.index') }}" class="btn btn-outline-success btn-sm mt-auto">Gestionar alergias</a>
                    </div>
                </div>
            </div>

            <!-- Historial de Comidas -->
            <div class="col-12 col-md">
                <div class="card card-custom h-100 p-2">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                        <i class="fas fa-apple-alt"></i>
                        <h5 class="card-title mt-2">Registro de Comidas</h5>
                        <p class="text-muted mb-2">Lleva el control de los alimentos consumidos.</p>
                        <a href="{{ route('comida.create') }}" class="btn btn-outline-success btn-sm mt-auto">
                            Registrar Comida
                        </a>

                    </div>
                </div>
            </div>

            <!-- Reporte de salud -->
            <div class="col-12 col-md">
                <div class="card card-custom h-100 p-2">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                        <i class="fas fa-heartbeat"></i>
                        <h5 class="card-title mt-2">Medidas de Salud</h5>
                        <p class="text-muted mb-2">Consulta tus últimas medidas de salud y evolución.</p>
                        <a href="#" class="btn btn-outline-success btn-sm mt-auto">Ver salud</a>
                    </div>
                </div>
            </div>

            <!-- Consejo del día -->
            <div class="col-12 col-md-12">
                <div class="card card-custom h-100 p-2">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                        <i class="fas fa-lightbulb"></i>
                        <h5 class="card-title mt-2">Consejo del día</h5>
                        <div class="consejo">
                            Agrega una fruta o verdura extra hoy y ¡mantente hidratado! 🍎🥒💧
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
