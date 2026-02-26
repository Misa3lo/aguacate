@extends('layouts.app')

@section('title', 'Panel de Control')

@section('content')

    <div class="welcome-hero">
        <div class="welcome-text">
            <h1>¡Hola de nuevo, {{ Auth::user()->nombre ?? 'Usuario' }}! <i class="fas fa-hand-holding-seedling text-accent"></i></h1>
            <p>Estás en la <strong>Plataforma KBI</strong>. Aquí puedes monitorear la salud mineral de tus cultivos de aguacate.</p>
        </div>
        <div class="welcome-date">
            <i class="far fa-calendar-alt"></i> {{ date('d/m/Y') }}
        </div>
    </div>

    <div class="dashboard-grid">

        <div class="dash-card">
            <div class="card-icon color-1">
                <i class="fas fa-database"></i>
            </div>
            <h3>Configuración Base</h3>
            <p>Administra los catálogos de nutrientes y el registro de productores.</p>
            <div class="card-actions">
                <a href="{{ route('elementos.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-flask"></i> Nutrientes</a>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-user-friends"></i> Dueños</a>
            </div>
        </div>

        <div class="dash-card">
            <div class="card-icon color-2">
                <i class="fas fa-vials"></i>
            </div>
            <h3>Operación y Campo</h3>
            <p>Registra nuevas muestras foliares y gestiona los huertos registrados.</p>
            <div class="card-actions">
                <a href="{{ route('parcelas.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-map-marked-alt"></i> Huertos</a>
                <a href="{{ route('muestreos.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-plus-circle"></i> Nueva Muestra</a>
            </div>
        </div>

        <div class="dash-card highlight">
            <div class="card-icon color-3">
                <i class="fas fa-chart-bar"></i>
            </div>
            <h3>Análisis y Reportes</h3>
            <p>Consulta los balances de Kenworthy y recomendaciones de fertilización.</p>
            <div class="card-actions">
                <a href="{{ route('analisis.index') }}" class="btn btn-primary btn-sm"><i class="fas fa-clipboard-check"></i> Ver Análisis</a>
            </div>
        </div>

    </div>

@endsection
