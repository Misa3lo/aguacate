<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KBI Diagnóstico | @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body style="background-color: var(--color-background);">

<div class="container-fluid p-0">
    <div class="d-flex">

        <nav class="sidebar d-flex flex-column p-0" style="width: 260px;">
            <div class="user-info-box p-4 d-flex justify-content-between align-items-center">
                <div class="text-truncate">
                    <i class="fas fa-user-circle fa-2x align-middle me-2"></i>
                    <span class="fw-bold">{{ Auth::user()->nombre ?? 'Invitado' }}</span>
                </div>
                <form action="{{ route('logout') ?? '#' }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger border-0 p-1 rounded-circle" title="Cerrar Sesión">
                        <i class="fas fa-power-off fa-lg text-white"></i>
                    </button>
                </form>
            </div>

            <ul class="nav nav-pills flex-column mb-auto p-3">
                <li class="nav-item">
                    <a href="{{ route('inicio') ?? '#' }}" class="nav-link {{ request()->routeIs('inicio') ? 'active' : '' }}">
                        <i class="fas fa-home me-2"></i> Inicio
                    </a>
                </li>

                <li class="menu-divider mt-4 mb-2">Datos Base</li>
                <li><a href="{{ route('usuarios.index') ?? '#' }}" class="nav-link"><i class="fas fa-users me-2"></i> Dueños</a></li>
                <li><a href="{{ route('elementos.index') ?? '#' }}" class="nav-link"><i class="fas fa-flask me-2"></i> Nutrientes</a></li>
                <li><a href="{{ route('referencias.index') ?? '#' }}" class="nav-link"><i class="fas fa-balance-scale me-2"></i> Referencias KBI</a></li>

                <li class="menu-divider mt-4 mb-2">Operación</li>
                <li><a href="{{ route('parcelas.index') ?? '#' }}" class="nav-link"><i class="fas fa-map-marked-alt me-2"></i> Huertos</a></li>
                <li><a href="{{ route('muestreos.index') ?? '#' }}" class="nav-link"><i class="fas fa-vial me-2"></i> Ingreso Muestras</a></li>

                <li class="menu-divider mt-4 mb-2">Resultados</li>
                <li><a href="{{ route('analisis.index') ?? '#' }}" class="nav-link"><i class="fas fa-chart-line me-2"></i> Análisis Kenworthy</a></li>
                <li><a href="{{ route('recomendaciones.index') ?? '#' }}" class="nav-link"><i class="fas fa-lightbulb me-2"></i> Recomendaciones</a></li>
            </ul>
        </nav>

        <main class="flex-grow-1 p-4 overflow-auto" style="height: 100vh;">
            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                <h1 class="h3 fw-bold text-dark">@yield('title')</h1>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="bg-white p-4 rounded shadow-sm">
                @yield('content')
            </div>
        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
