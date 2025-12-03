@extends('layouts.app')

@section('title', 'Dashboard Principal')

@section('content')

    <div class="welcome-banner">
        <h1>¡Bienvenido, {{ Auth::user()->nombre ?? 'Usuario' }}!</h1>
        <p>Sistema de Gestión de Análisis de Nutrientes de Parcelas Agrícolas (NutriFarm)</p>
        <p>Utiliza el menú lateral para acceder a la gestión de catálogos y el flujo de muestreo.</p>
    </div>

    <hr>

    <div class="dashboard-grid">

        <div class="card card-summary">
            <i class="fas fa-list-alt"></i>
            <h2>Catálogos</h2>
            <p>Gestiona Elementos de Nutrientes y Dueños de Parcelas.</p>
            <a href="{{ route('elementos.index') }}" class="btn btn-secondary">Ver Elementos</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Ver Dueños</a>
        </div>

        <div class="card card-summary">
            <i class="fas fa-map-marked-alt"></i>
            <h2>Campo y Muestreo</h2>
            <p>Registra y administra las parcelas y sus visitas de campo.</p>
            <a href="{{ route('parcelas.index') }}" class="btn btn-secondary">Ver Parcelas</a>
            <a href="{{ route('revisiones.index') }}" class="btn btn-secondary">Ver Revisiones</a>
        </div>

        <div class="card card-summary">
            <i class="fas fa-chart-line"></i>
            <h2>Análisis y Resultados</h2>
            <p>Consulta los resultados de las muestras y las recomendaciones de fertilización.</p>
            <a href="{{ route('analisis.index') }}" class="btn btn-secondary">Ver Análisis</a>
            <a href="{{ route('recomendaciones.index') }}" class="btn btn-secondary">Ver Recomendaciones</a>
        </div>

    </div>

@endsection

@section('styles')
    <style>
        .welcome-banner {
            background-color: var(--color-light-gray);
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 25px;
            text-align: center;
            color: var(--color-dark-text);
        }
        .welcome-banner h1 {
            color: var(--color-primary);
            margin-top: 0;
            font-size: 2.2rem;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .card-summary {
            background-color: var(--color-white);
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            text-align: center;
        }
        .card-summary i {
            font-size: 3rem;
            color: var(--color-accent);
            margin-bottom: 15px;
        }
        .card-summary h2 {
            color: var(--color-dark-text);
            margin-bottom: 15px;
        }
        .card-summary a {
            margin-top: 10px;
            display: inline-block;
        }
    </style>
@endsection
