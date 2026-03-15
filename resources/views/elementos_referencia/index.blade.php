@extends('layouts.app')

@section('title', 'Valores de Referencia Kenworthy')

@section('content')

    <div class="action-bar d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted m-0">Establece los valores óptimos (Media) y la variabilidad (C.V.) para cada nutriente.</p>
        <a href="{{ route('referencias.create') }}" class="btn btn-primary">
            <i class="fas fa-balance-scale"></i> Agregar Valor de Referencia
        </a>
    </div>

    @if ($referencias->isEmpty())
        <div class="empty-state">
            <i class="fas fa-calculator"></i>
            <h3>Faltan Parámetros de Control</h3>
            <p>No se han registrado valores de referencia aún.</p>
            <p>El sistema necesita la <strong>Media Óptima</strong> para comparar los resultados de las muestras.</p>
            <a href="{{ route('referencias.create') }}" class="btn btn-secondary mt-2">Configurar Referencia</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                    <th style="width: 60px;">ID</th>
                    <th><i class="fas fa-flask"></i> Nutriente</th>
                    <th class="text-center"><i class="fas fa-bullseye"></i> Valor Ideal (Media)</th>
                    <th class="text-center"><i class="fas fa-percentage"></i> Coef. Variación</th>
                    <th class="text-center"><i class="fas fa-calendar-alt"></i> Registro</th>
                    <th style="width: 120px;" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($referencias as $referencia)
                    <tr>
                        <td class="text-muted">#{{ $referencia->Id }}</td>
                        {{-- Acceso al nombre del elemento mediante la relación --}}
                        <td>
                            <strong>{{ $referencia->element->Name }}</strong>
                            <small class="text-muted d-block">{{ $referencia->element->Unit }}</small>
                        </td>
                        <td class="text-center">
                        <span class="badge bg-light text-dark" style="font-size: 1.1em;">
                            {{ number_format($referencia->Reference_value, 4) }}
                        </span>
                        </td>
                        <td class="text-center">
                            {{ number_format($referencia->Deviation_coefficient, 4) }}
                        </td>
                        <td class="text-center" style="font-size: 0.85em;">
                            @if($referencia->Created_at)
                                <div>{{ $referencia->Created_at->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $referencia->Created_at->format('H:i') }}</small>
                            @else
                                <span class="text-muted">---</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('referencias.edit', $referencia->Id) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('referencias.destroy', $referencia->Id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar referencia?')">
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
