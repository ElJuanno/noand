@extends('layouts.app')

@section('title', 'Registro de Comidas')

@section('content')
    <div class="container mt-5" style="max-width: 900px;">
        <h3 class="text-success mb-4">Resumen Diario de Comidas Seguidas</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($resumenDiario->isEmpty())
            <p>No has registrado comidas hoy.</p>
        @else
            <table class="table table-bordered">
                <thead class="table-success">
                <tr>
                    <th>Comida</th>
                    <th>Calorías</th>
                    <th>Azúcar</th>
                    <th>Carbohidratos</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resumenDiario as $item)
                    <tr>
                        <td>{{ $item->comida }}</td>
                        <td>{{ number_format($item->calorias, 2) }}</td>
                        <td>{{ number_format($item->azucar, 2) }}</td>
                        <td>{{ number_format($item->carbohidratos, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        {{-- Gráfica semanal --}}
        @if($datosSemana->isNotEmpty())
            <div class="mt-5">
                <h4 class="text-primary">Progreso Semanal</h4>
                <canvas id="graficaProgreso" height="100"></canvas>
            </div>
        @endif

        {{-- Gráficas por hora (calorías, azúcar, carbohidratos) --}}
        @if($porHora->isNotEmpty())
            <div class="mt-5">
                <h4 class="text-success">Distribución por Hora (Hoy)</h4>

                <canvas id="graficaHoraCalorias" height="80" class="mb-4"></canvas>
                <canvas id="graficaHoraAzucar" height="80" class="mb-4"></canvas>
                <canvas id="graficaHoraCarbs" height="80"></canvas>
            </div>
        @endif
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Gráfica semanal --}}
    @if($datosSemana->isNotEmpty())
        <script>
            const labels = @json($datosSemana->pluck('fecha'));
            const dataCalorias = @json($datosSemana->pluck('calorias'));
            const dataAzucar = @json($datosSemana->pluck('azucar'));
            const dataCarbs = @json($datosSemana->pluck('carbohidratos'));

            const ctx = document.getElementById('graficaProgreso').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Calorías',
                            data: dataCalorias,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            tension: 0.3
                        },
                        {
                            label: 'Azúcar',
                            data: dataAzucar,
                            borderColor: 'rgba(255, 159, 64, 1)',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            tension: 0.3
                        },
                        {
                            label: 'Carbohidratos',
                            data: dataCarbs,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Consumo diario - Últimos 7 días'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endif

    {{-- Gráficas por hora --}}
    @if($porHora->isNotEmpty())
        <script>
            const horas = @json($porHora->pluck('hora'));
            const caloriasHora = @json($porHora->pluck('calorias'));
            const azucarHora = @json($porHora->pluck('azucar'));
            const carbsHora = @json($porHora->pluck('carbohidratos'));

            const configChart = (ctxId, label, data, color) => {
                return new Chart(document.getElementById(ctxId), {
                    type: 'bar',
                    data: {
                        labels: horas,
                        datasets: [{
                            label: label,
                            data: data,
                            backgroundColor: color[0],
                            borderColor: color[1],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: `${label} por hora`
                            }
                        },
                        scales: {
                            x: {
                                title: { display: true, text: 'Hora del día' }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            };

            configChart('graficaHoraCalorias', 'Calorías', caloriasHora, ['rgba(75, 192, 192, 0.5)', 'rgba(75, 192, 192, 1)']);
            configChart('graficaHoraAzucar', 'Azúcar', azucarHora, ['rgba(255, 159, 64, 0.5)', 'rgba(255, 159, 64, 1)']);
            configChart('graficaHoraCarbs', 'Carbohidratos', carbsHora, ['rgba(54, 162, 235, 0.5)', 'rgba(54, 162, 235, 1)']);
        </script>
    @endif

    {{-- Errores --}}
    @if($errors->any())
        <div class="alert alert-danger mt-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
