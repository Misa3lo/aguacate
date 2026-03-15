@extends('layouts.app')

@section('title', 'Registro de Revisiones de Campo')

@section('content')

    <div class="action-bar d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted m-0">Gestiona las fechas de visita y recolección de muestras foliares.</p>
        <a href="{{ route('revisiones.create') }}" class="btn btn-primary">
            <i class="fas fa-calendar-plus"></i> Registrar Nueva Revisión
        </a>
    </div>

    @if ($revisiones->isEmpty())
        <div class="empty-state text-center p-5">
            <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
            <h3>Sin visitas programadas</h3>
            <p>No se han registrado revisiones de parcelas aún.</p>
            <a href="{{ route('revisiones.create') }}" class="btn btn-secondary mt-2">Crear primera revisión</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table table table-hover">
                <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th><i class="fas fa-calendar-check"></i> Fecha de Revisión</th>
                    <th><i class="fas fa-map-marker-alt"></i> Parcela (ID)</th>
                    <th><i class="fas fa-directions"></i> Ubicación del Huerto</th>
                    <th style="width: 140px;" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($revisiones as $revision)
                    <tr>
                        <td><strong>#{{ $revision->Id }}</strong></td>
                        <td>{{ \Carbon\Carbon::parse($revision->Review_date)->format('d/m/Y') }}</td>
                        <td><span class="badge bg-light text-dark">ID: {{ $revision->Plot_id }}</span></td>
                        <td>{{ $revision->plot->Address ?? 'Dirección no registrada' }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('revisiones.edit', $revision->Id) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('revisiones.destroy', $revision->Id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta revisión?')">
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
