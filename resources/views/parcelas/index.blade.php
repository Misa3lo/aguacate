@extends('layouts.app')

@section('title', 'Gestión de Parcelas Agrícolas')

@section('content')

    <div class="action-bar d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted m-0">Administra los huertos de aguacate registrados para el diagnóstico mineral.</p>
        <a href="{{ route('parcelas.create') }}" class="btn btn-primary">
            <i class="fas fa-map-marker-alt"></i> Registrar Nueva Parcela
        </a>
    </div>

    @if ($parcelas->isEmpty())
        <div class="empty-state">
            <i class="fas fa-map-marked"></i>
            <h3>No hay huertos registrados</h3>
            <p>Comienza registrando una nueva parcela para iniciar el proceso de muestreo.</p>
            <a href="{{ route('parcelas.create') }}" class="btn btn-secondary mt-2">Registrar Parcela</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                    <th style="width: 50px;">ID</th>
                    <th><i class="fas fa-user-tie"></i> Dueño / Productor</th>
                    <th><i class="fas fa-directions"></i> Ubicación</th>
                    <th class="text-center"><i class="fas fa-expand-arrows-alt"></i> Extensión</th>
                    <th class="text-center"><i class="fas fa-tree"></i> Árboles</th>
                    <th><i class="fas fa-location-arrow"></i> GPS</th>
                    <th style="width: 140px;" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($parcelas as $parcela)
                    <tr>
                        <td><span class="text-muted">#{{ $parcela->id }}</span></td>
                        <td>
                            <span class="fw-bold text-dark">{{ $parcela->usuario->nombre ?? 'N/A' }}</span>
                        </td>
                        <td><small>{{ $parcela->direccion }}</small></td>
                        <td class="text-center">
                                <span class="badge bg-no-aplicar">
                                    {{ number_format($parcela->extension_ha, 2) }} ha
                                </span>
                        </td>
                        <td class="text-center">
                                <span class="fw-bold text-secondary">
                                    {{ number_format($parcela->num_arboles) }}
                                </span>
                        </td>
                        <td>
                            <code class="text-primary" style="font-size: 0.85rem;">
                                {{ $parcela->coordenada_gps ?: 'Sin GPS' }}
                            </code>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('parcelas.edit', $parcela->id) }}"
                                   class="btn btn-secondary btn-sm"
                                   title="Editar datos de la parcela">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('parcelas.destroy', $parcela->id) }}"
                                      method="POST"
                                      class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Eliminar Parcela"
                                            onclick="return confirm('¿Eliminar parcela? Se borrarán también sus registros de muestreo asociados.')">
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
