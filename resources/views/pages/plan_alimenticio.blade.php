@extends('layouts.app')

@section('title', 'Plan Alimenticio')

@section('content')
    @php
        $ordenTiempos = ['Desayuno', 'Almuerzo', 'Comida', 'Cena', 'Snack'];

        function limpiarIngredientes($ingredientes) {
            if (!$ingredientes) return '';
            if (preg_match('/^c\((.*)\)$/', trim($ingredientes), $matches)) {
                $contenido = $matches[1];
                $items = preg_split('/",\s*"|\',\s*\'/', trim($contenido, '"\' '));
                return implode(', ', $items);
            }
            return $ingredientes;
        }
    @endphp

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        body {
            background: #f5fef9 !important;
            font-family: 'Inter', sans-serif;
        }

        .plan-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #41b883;
            margin-bottom: 1.8rem;
        }

        .plan-subtitle {
            font-size: 1.35rem;
            font-weight: 600;
            color: #419669;
            margin-top: 2.2rem;
            margin-bottom: 1rem;
        }

        .plan-card {
            border-radius: 18px !important;
            transition: box-shadow 0.3s, transform 0.3s;
            background: #fff;
            border-left: 6px solid transparent;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s forwards;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .plan-card:hover {
            box-shadow: 0 8px 24px rgba(52, 180, 112, 0.15);
            transform: translateY(-6px);
        }

        .plan-card.border-success {
            border-color: #2ecc71;
            background: #ecfcf6 !important;
        }

        .plan-card.border-warning {
            border-color: #f1c40f;
            background: #fffbea !important;
        }

        .plan-card.border-danger {
            border-color: #e74c3c;
            background: #fff1f0 !important;
        }

        .card-title {
            font-weight: 700;
            font-size: 1.15rem;
            color: #41b883;
        }

        .plan-detail {
            font-size: 0.97rem;
            color: #344e41;
        }

        .badge-custom {
            margin-right: 0.4rem;
            font-size: 0.9rem;
            padding: 0.4em 0.7em;
            font-weight: 600;
        }

        .empty-section {
            background: #fff9c0;
            border-radius: 11px;
            padding: 1.2rem 1.6rem;
            font-size: 1.11rem;
            color: #9e8800;
            margin: 2rem 0;
            text-align: center;
            font-weight: 600;
        }

        .btn-seguir {
            margin-top: 1rem;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 600;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="container mt-5 mb-5" style="max-width:1080px;">
        <h2 class="plan-title">Plan Alimenticio Personalizado</h2>

        @if(isset($agrupadas) && count($agrupadas) > 0)
            @foreach($ordenTiempos as $tiempo)
                @php $lista = $agrupadas[$tiempo] ?? []; @endphp
                @if(is_array($lista) && count($lista) > 0)
                    <div class="plan-subtitle">{{ $tiempo }}</div>
                    <div class="row">
                        @foreach($lista as $i => $receta)
                            @php
                                $colorClase = 'border-success';
                                if(($receta['color'] ?? '') == 'amarillo') $colorClase = 'border-warning';
                                if(($receta['color'] ?? '') == 'rojo') $colorClase = 'border-danger';
                                $ingredientesLimpios = limpiarIngredientes($receta['ingredientes'] ?? '');
                            @endphp
                            <div class="col-md-6 col-lg-4 mb-4 d-flex">
                                <div class="card plan-card {{ $colorClase }} flex-fill" style="animation-delay: {{ 0.05 * $i }}s;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h6 class="card-title">{{ $receta['nombre'] ?? 'Sin nombre' }}</h6>
                                            <div class="plan-detail mb-3">
                                                <i class="bi bi-list-ul text-secondary"></i>
                                                <strong>Ingredientes:</strong>
                                                <span data-bs-toggle="tooltip" title="{{ $ingredientesLimpios }}">
                                                {{ \Illuminate\Support\Str::limit($ingredientesLimpios, 90) }}
                                            </span><br>
                                                <i class="bi bi-tags text-secondary"></i>
                                                <strong>Categoría:</strong> {{ $receta['categoria'] ?? 'Sin categoría' }}
                                            </div>
                                            <div class="pt-2">
                                            <span class="badge bg-success-subtle text-success badge-custom">
                                                <i class="bi bi-fire"></i> {{ $receta['calorias'] ?? 'N/A' }} Cal
                                            </span>
                                                <span class="badge bg-warning-subtle text-warning badge-custom">
                                                <i class="bi bi-droplet"></i> {{ $receta['azucar'] ?? 'N/A' }} Azúcar
                                            </span>
                                                <span class="badge bg-info-subtle text-primary badge-custom">
                                                <i class="bi bi-box"></i> {{ $receta['carbohidratos'] ?? 'N/A' }} Carbs
                                            </span>
                                                <form action="{{ route('comida.store') }}" method="POST" class="mt-2">
                                                    @csrf
                                                    <input type="hidden" name="nombre" value="{{ $receta['nombre'] }}">
                                                    <input type="hidden" name="hora" value="{{ now()->format('H:i:s') }}">
                                                    <input type="hidden" name="calorias" value="{{ $receta['calorias'] }}">
                                                    <input type="hidden" name="azucar" value="{{ $receta['azucar'] }}">
                                                    <input type="hidden" name="carbohidratos" value="{{ $receta['carbohidratos'] }}">
                                                    <button type="submit" class="btn btn-success btn-sm w-100">Seguir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        @else
            <div class="empty-section">
                No se encontraron recomendaciones, verifica tus datos o inténtalo más tarde.
            </div>
        @endif
    </div>

    {{-- Activar tooltips --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltips.forEach(t => new bootstrap.Tooltip(t));
        });
    </script>
@endsection
