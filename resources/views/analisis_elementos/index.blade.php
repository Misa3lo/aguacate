@extends('layouts.app')

@section('title', 'Resultados: Índice de Kenworthy')

@section('content')

    <div class="action-bar d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted m-0">Consulta del diagnóstico mineral basado en valores de laboratorio.</p>
        <div class="d-flex gap-2">
            <a href="{{ route('muestreos.index') }}" class="btn btn-secondary">
                <i class="fas fa-flask"></i> Ver Muestras
            </a>
        </div>
    </div>

    @if ($analisis->isEmpty())
        <div class="empty-state text-center">
            <i class="fas fa-microscope fa-3x mb-3 text-muted"></i>
            <h3>No hay análisis registrados</h3>
            <p>Los resultados aparecerán aquí una vez que se procesen los datos de laboratorio.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table table table-hover">
                <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th><i class="fas fa-leaf text-success"></i> Muestra / Elemento</th>
                    <th class="text-center">Índice Kenworthy</th>
                    <th class="text-center">Estado Nutricional</th>
                    <th class="text-center">Recomendación</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($analisis as $item)
                    <tr>
                        {{-- 1. ID --}}
                        <td><span class="badge bg-light text-dark border">#{{ $item->Id }}</span></td>

                        {{-- 2. Elemento --}}
                        <td>
                            @if($item->plotElement && $item->plotElement->element)
                                <strong>{{ $item->plotElement->element->Name }}</strong><br>
                                <small class="text-muted">ID Muestra: {{ $item->Plot_element_id }}</small>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>

                        {{-- 3. Valor del Índice --}}
                        <td class="fw-bold text-center" style="font-size: 1.1em;">
                            {{ number_format($item->ind_kenworthy, 2) }}
                        </td>

                        {{-- 4. Nivel de Suficiencia --}}
                        <td class="text-center">
                            @php
                                // 1. Obtenemos el valor de la base de datos (asegúrate que la columna es nivel_suficiencia)
                                $valorSuficiencia = $item->nivel_suficiencia ?? 'SIN DATO';
                                $nivel = strtolower($valorSuficiencia);

                                $badgeClass = 'bg-secondary'; // Color gris por defecto si no coincide nada

                                // 2. Lógica de colores basada en las palabras clave de tu SQL
                                if (str_contains($nivel, 'bajo') || str_contains($nivel, 'deficiente')) {
                                    $badgeClass = 'bg-danger'; // Rojo
                                } elseif (str_contains($nivel, 'normal') || str_contains($nivel, 'suficiente') || str_contains($nivel, 'optimo')) {
                                    $badgeClass = 'bg-success'; // Verde
                                } elseif (str_contains($nivel, 'alto') || str_contains($nivel, 'exceso')) {
                                    $badgeClass = 'bg-warning text-dark'; // Amarillo/Naranja
                                }
                            @endphp

                            {{-- 3. Imprimimos el badge con el texto en mayúsculas --}}
                            <span class="badge {{ $badgeClass }}" style="padding: 8px 12px; min-width: 110px; display: inline-block;">
        {{ strtoupper($valorSuficiencia) }}
    </span>
                        </td>

                        {{-- 5. Recomendación --}}
                        <td class="text-center">
                            @if(str_contains(strtolower($item->necesidad_aplicacion), 'aplicar'))
                                <span class="text-danger fw-bold">
                                    <i class="fas fa-exclamation-triangle"></i> REQUIERE APLICACIÓN
                                </span>
                            @else
                                <span class="text-success">
                                    <i class="fas fa-check-circle"></i> SIN ACCIÓN
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection
