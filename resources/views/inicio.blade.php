@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')

    <div class="welcome-hero">
        <div class="welcome-text">
            <h1>¡Hola de nuevo, {{ Auth::user()->Name ?? 'Usuario' }}! <i class="fas fa-hand-holding-seedling text-accent"></i></h1>            <p>Estás en la <strong>Plataforma KBI</strong>. Monitoreo mineral para tus cultivos de aguacate.</p>
        </div>
        <div class="welcome-date">
            <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="dash-card">
            <div class="card-icon color-1"><i class="fas fa-database"></i></div>
            <h3>Configuración</h3>
            <div class="card-actions">
                <a href="{{ route('elementos.index') }}" class="btn btn-secondary btn-sm">Nutrientes</a>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm">Dueños</a>
            </div>
        </div>

        <div class="dash-card">
            <div class="card-icon color-2"><i class="fas fa-vials"></i></div>
            <h3>Operación</h3>
            <div class="card-actions">
                <a href="{{ route('parcelas.index') }}" class="btn btn-secondary btn-sm">Huertos</a>
                <a href="{{ route('muestreos.index') }}" class="btn btn-secondary btn-sm">Muestreos</a>
            </div>
        </div>

        <div class="dash-card highlight">
            <div class="card-icon color-3"><i class="fas fa-chart-line"></i></div>
            <h3>Resultados</h3>
            <div class="card-actions">
                <a href="{{ route('analisis.index') }}" class="btn btn-primary btn-sm">Índices</a>
                <a href="{{ route('recomendaciones.index') }}" class="btn btn-primary btn-sm">Aplicaciones</a>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="dash-card no-hover" style="width: 100%;">
            <h3 class="mb-4"><i class="fas fa-chart-bar text-accent"></i> Balance Nutricional Promedio</h3>
            <div style="position: relative; height:350px;">
                <canvas id="kenworthyChart"></canvas>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('kenworthyChart').getContext('2d');

        // Obtenemos los datos del controlador o arreglos vacíos por seguridad
        const labels = {!! json_encode($nombresElementos ?? []) !!};
        const values = {!! json_encode($valoresKenworthy ?? []) !!};

        if (labels.length === 0) {
            // Mensaje opcional si no hay datos
            console.log("No hay datos de análisis para mostrar en la gráfica.");
        }

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Promedio Índice Kenworthy',
                    data: values,
                    backgroundColor: values.map(v => {
                        if (v < 50) return 'rgba(231, 76, 60, 0.7)'; // Rojo: Bajo
                        if (v > 110) return 'rgba(241, 196, 15, 0.7)'; // Amarillo: Alto
                        return 'rgba(46, 204, 113, 0.7)'; // Verde: Óptimo
                    }),
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true, max: 150 },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
@endpush
