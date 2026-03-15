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
        <div class="empty-state text-center">
            <i class="fas fa-vial fa-3x mb-3 text-muted"></i>
            <h3>Sin mediciones capturadas</h3>
            <p>No se han registrado mediciones de muestras de nutrientes aún.</p>
            <a href="{{ route('muestreos.create') }}" class="btn btn-secondary mt-2">Registrar primera medición</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th><i class="fas fa-map-marker-alt"></i> Parcela / Huerto</th>
                    <th><i class="fas fa-flask"></i> Elemento</th>
                    <th class="text-center"><i class="fas fa-microscope"></i> Valor Observado</th>
                    <th class="text-center"><i class="fas fa-calendar-day"></i> Fecha Revisión</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($muestreos as $m)
                    <tr>
                        <td>{{ $m->Id }}</td>
                        <td>
                            <strong>Huerto ID: {{ $m->Plot_id }}</strong><br>
                            <small class="text-muted">Árboles: {{ $m->plot->Tree_count ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <span class="badge bg-info text-dark">{{ $m->element->Name ?? 'N/A' }}</span>
                        </td>
                        <td class="text-center">
                            <span class="fw-bold text-primary">{{ $m->Observed_value }}</span>
                            <small>{{ $m->element->Unit ?? '' }}</small>
                        </td>
                        <td class="text-center">
                            {{ $m->review->Review_date ?? 'Sin fecha' }}
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('muestreos.edit', $m->Id) }}" class="btn btn-secondary btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('muestreos.destroy', $m->Id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta medición?')">
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
