@extends('layouts.app')

@section('title', 'Registro de Muestras Foliares')

@section('content')

    <div class="action-bar d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted m-0">Historial de mediciones capturadas para el cálculo del Índice de Kenworthy.</p>
        <a href="{{ route('muestreos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Ingresar Nueva Muestra
        </a>
    </div>

    @if ($muestreos->isEmpty())
        <div class="empty-state">
            <i class="fas fa-vial"></i>
            <h3>Sin mediciones capturadas</h3>
            <p>No se han registrado mediciones de muestras de nutrientes aún.</p>
            <p>Comienza a ingresar los valores de laboratorio para generar los diagnósticos.</p>
            <a href="{{ route('muestreos.create') }}" class="btn btn-secondary mt-2">Registrar primera medición</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th><i class="fas fa-map-marker-alt"></i> Parcela / Ubicación</th>
                    <th><i class="fas fa-flask"></i> Elemento</th>
                    <th class="text-center"><i class="fas fa-calendar-day"></i> Fecha Revisión</th>
                    <th class="text-center"><i class="fas fa-microscope"></i> Valor Observado</th>
                    <th style="width: 140px;" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($muestreos as $muestreo)
                    <tr>
                        <td><span class="text-muted">#{{ $muestreo->id }}</span></td>
                        <td>
                            <div class="fw-bold text-dark">ID: {{ $muestreo->parcela_id }}</div>
                            <small class="text-muted">{{ Str::limit($muestreo->parcela->direccion ?? 'N/A', 30) }}</small>
                        </td>
                        <td>
                                <span class="fw-bold" style="color: var(--color-primary);">
                                    {{ $muestreo->elemento->nombre ?? 'N/A' }}
                                </span>
                            <small class="badge bg-no-aplicar p-1" style="font-size: 0.7rem;">
                                {{ $muestreo->elemento->unit ?? ($muestreo->elemento->unidad ?? '') }}
                            </small>
                        </td>
                        <td class="text-center">
                                <span class="text-secondary">
                                    {{ \Carbon\Carbon::parse($muestreo->revision->fecha_revision)->format('d/m/Y') }}
                                </span>
                            <br>
                            <small class="text-muted" style="font-size: 0.7rem;">Rev #{{ $muestreo->revision_id }}</small>
                        </td>
                        <td class="text-center">
                                <span class="badge bg-aplicar" style="font-size: 1rem; min-width: 100px;">
                                    {{ number_format($muestreo->valor_observado, 4) }}
                                </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('muestreos.edit', $muestreo->id) }}"
                                   class="btn btn-secondary btn-sm"
                                   title="Editar medición">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('muestreos.destroy', $muestreo->id) }}"
                                      method="POST"
                                      class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Eliminar muestra"
                                            onclick="return confirm('¿Está seguro de que desea eliminar esta medición? Se perderá el dato para el cálculo de análisis.')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

@endsection
