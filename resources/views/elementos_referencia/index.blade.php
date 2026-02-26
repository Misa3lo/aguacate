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
                    <th class="text-center">Unidad</th>
                    <th style="width: 140px;" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($referencias as $referencia)
                    <tr>
                        <td><span class="text-muted">#{{ $referencia->id }}</span></td>
                        <td>
                                <span class="fw-bold text-dark" style="font-size: 1.1rem;">
                                    {{ $referencia->elemento->nombre ?? 'N/A' }}
                                </span>
                        </td>
                        <td class="text-center">
                                <span class="badge bg-aplicar" style="font-size: 1rem; min-width: 90px;">
                                    {{ number_format($referencia->valor_referencia, 4) }}
                                </span>
                        </td>
                        <td class="text-center">
                                <span class="text-secondary fw-bold">
                                    {{ number_format($referencia->coef_variacion, 4) }}
                                </span>
                        </td>
                        <td class="text-center">
                                <span class="badge bg-no-aplicar">
                                    {{ $referencia->elemento->unidad ?? 'N/A' }}
                                </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('referencias.edit', $referencia->id) }}"
                                   class="btn btn-secondary btn-sm"
                                   title="Editar parámetros">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('referencias.destroy', $referencia->id) }}"
                                      method="POST"
                                      class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Eliminar referencia"
                                            onclick="return confirm('¡Atención! Eliminar esta referencia impedirá realizar diagnósticos para este nutriente. ¿Desea continuar?')">
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
