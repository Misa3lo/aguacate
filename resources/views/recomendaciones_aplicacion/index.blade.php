@extends('layouts.app')

@section('title', 'Recomendaciones de Fertilización')

@section('content')

    <div class="action-bar mb-4">
        <p class="text-muted m-0">Basado en el análisis mineral, estas son las aplicaciones sugeridas para optimizar el cultivo.</p>
    </div>

    @if ($recomendaciones->isEmpty())
        <div class="empty-state text-center">
            <i class="fas fa-lightbulb text-warning fa-3x mb-3"></i>
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
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($recomendaciones as $rec)
                    <tr>
                        <td><span class="text-muted">#{{ $rec->Id }}</span></td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                Análisis #{{ $rec->Analysis_id }}
                            </span>
                        </td>
                        <td>
                            <strong class="text-dark">{{ strtoupper($rec->Nutrient_type) }}</strong>
                        </td>
                        <td class="text-center">
                            {{-- Mantenemos tu clase bg-aplicar para resaltar la dosis --}}
                            <span class="badge bg-aplicar" style="font-size: 1.1rem; min-width: 120px;">
                                {{ number_format($rec->Recommended_amount, 2) }}
                                <small>{{ $rec->Unit }}</small>
                            </span>
                        </td>
                        <td class="text-center">
                            <small class="text-secondary">
                                {{ \Carbon\Carbon::parse($rec->Recommendation_date)->format('d/m/Y') }}
                            </small>
                        </td>
                        <td class="text-center">
                            {{-- Lógica para mostrar si ya fue aplicada la recomendación --}}
                            @if(isset($rec->Is_applied) && $rec->Is_applied)
                                <i class="fas fa-check-circle text-success" title="Aplicada"></i>
                                <small class="text-success d-block">Aplicada</small>
                            @else
                                <i class="fas fa-clock text-warning" title="Pendiente"></i>
                                <small class="text-warning d-block">Pendiente</small>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('recomendaciones.show', $rec->Id) }}" class="btn btn-sm btn-outline-primary" title="Ver Detalle">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{-- Si quieres permitir editar la recomendación --}}
                                <a href="{{ route('recomendaciones.edit', $rec->Id) }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection
