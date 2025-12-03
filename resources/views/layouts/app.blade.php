<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrientes Parcela | @yield('title')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<div class="app-container">

    <header class="app-header">
        <div class="logo">
            <i class="fas fa-seedling"></i> <span>NutriFarm</span>
        </div>

        <div class="user-info">
            <i class="fas fa-user-circle"></i>
            <span class="user-name">Usuario Actual (Ej. Juan Pérez)</span>

            <form action="#" method="POST" class="logout-form">
                <button type="submit" title="Cerrar Sesión">
                    <i class="fas fa-sign-out-alt"></i> Salir
                </button>
            </form>
        </div>
    </header>

    <nav class="app-sidebar">
        <ul class="menu">
            <li class="menu-item"><a href="{{ route('inicio') }}"><i class="fas fa-home"></i> Inicio</a></li>

            <li class="menu-divider">Datos Base</li>
            <li class="menu-item"><a href="{{ route('usuarios.index') }}"><i class="fas fa-users"></i> Dueños</a></li>
            <li class="menu-item"><a href="{{ route('elementos.index') }}"><i class="fas fa-flask"></i> Nutrientes</a></li>
            <li class="menu-item"><a href="{{ route('referencias.index') }}"><i class="fas fa-balance-scale"></i> Referencias</a></li>

            <li class="menu-divider">Operación y Muestreo</li>
            <li class="menu-item"><a href="{{ route('parcelas.index') }}"><i class="fas fa-map-marked-alt"></i> Parcelas</a></li>
            <li class="menu-item"><a href="{{ route('revisiones.index') }}"><i class="fas fa-calendar-check"></i> Revisiones</a></li>
            <li class="menu-item"><a href="{{ route('muestreos.index') }}"><i class="fas fa-vial"></i> Ingreso Muestras</a></li>

            <li class="menu-divider">Resultados</li>
            <li class="menu-item"><a href="{{ route('analisis.index') }}"><i class="fas fa-chart-line"></i> Análisis</a></li>
            <li class="menu-item"><a href="{{ route('recomendaciones.index') }}"><i class="fas fa-lightbulb"></i> Recomendaciones</a></li>
        </ul>
    </nav>

    <main class="app-content">
        <h1>@yield('title')</h1>

        @if (session('success'))
            <div class="alert success-alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert error-alert">
                <i class="fas fa-exclamation-triangle"></i> Por favor, corrija los siguientes errores:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

</div> @yield('scripts')
</body>
</html>
