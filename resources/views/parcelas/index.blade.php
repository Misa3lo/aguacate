@extends('layouts.app')

@section('title', 'Gestión de Parcelas Agrícolas')

@section('content')

    <div class="action-bar d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted m-0">Administra los huertos registrados para el diagnóstico mineral.</p>
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
                    <th><i class="fas fa-user-tie"></i> Dueño</th>
                    <th><i class="fas fa-map-signs"></i> Localidad</th>
                    <th class="text-center">Extensión</th>
                    <th class="text-center">Árboles</th>
                    <th>GPS</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($parcelas as $parcela)
                    <tr>
                        <td>{{ $parcela->Id }}</td>
                        <td><strong>{{ $parcela->userPlot->Name ?? 'Sin dueño' }}</strong></td>
                        <td>{{ $parcela->locality->Name ?? 'N/A' }}</td>
                        <td class="text-center">{{ $parcela->Area_ha }} ha</td>
                        <td class="text-center">{{ $parcela->Tree_count }}</td>
                        <td>
                            <small class="text-muted">Lat: {{ $parcela->Latitude }}</small><br>
                            <small class="text-muted">Lon: {{ $parcela->Longitude }}</small>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('parcelas.edit', $parcela->Id) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('parcelas.destroy', $parcela->Id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar parcela?')">
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
