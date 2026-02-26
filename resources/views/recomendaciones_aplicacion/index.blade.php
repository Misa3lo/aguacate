@extends('layouts.app')

@section('title', 'Recomendaciones de Fertilización')

@section('content')

    <div class="action-bar mb-4">
        <p class="text-muted m-0">Basado en el análisis mineral, estas son las aplicaciones sugeridas para optimizar el cultivo.</p>
    </div>

    @if ($recomendaciones->isEmpty())
        <div class="empty-state">
            <i class="fas fa-lightbulb text-warning"></i>
            <h3>Sin recomendaciones pendientes</h3>
            <p>Las recomendaciones se generan automáticamente tras procesar los análisis de laboratorio.</p>
            <a href="{{ route('analisis.index') }}" class="btn btn-secondary mt-2">Revisar Análisis</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th><i class="fas fa-hashtag"></i> Ref. Análisis</th>
                    <th><i class="fas fa-seedling"></i> Tipo de Nutriente</th>
                    <th class="text-center"><i class="fas fa-balance-scale"></i> Cantidad Sugerida</th>
                    <th class="text-center"><i class="fas fa-calendar-alt"></i> Fecha</th>
                    <th class="text-center">Estado</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($recomendaciones as $recomendacion)
                    <tr>
                        <td><span class="text-muted">#{{ $recomendacion->id }}</span></td>
                        <td>
                                <span class="badge bg-no-aplicar">
                                    Análisis #{{ $recomendacion->analisis_elemento_id }}
                                </span>
                        </td>
                        <td>
                            <strong class="text-dark">{{ strtoupper($recomendacion->tipo_nutriente) }}</strong>
                        </td>
                        <td class="text-center">
                                <span class="badge bg-aplicar" style="font-size: 1.1rem; min-width: 120px;">
                                    {{ number_format($recomendacion->cantidad_recomendada, 2) }}
                                    <small>{{ $recomendacion->unidad_aplicacion }}</small>
                                </span>
                        </td>
                        <td class="text-center">
                            <small class="text-secondary">
                                {{ \Carbon\Carbon::parse($recomendacion->fecha_recomendacion)->format('d/m/Y') }}
                            </small>
                        </td>
                        <td class="text-center">
                            <i class="fas fa-check-circle text-success" title="Generada correctamente"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection
