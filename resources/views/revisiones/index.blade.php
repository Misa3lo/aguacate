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
        <div class="empty-state">
            <i class="fas fa-calendar-alt"></i>
            <h3>Sin visitas programadas</h3>
            <p>No se han registrado revisiones de parcelas aún.</p>
            <p>Comienza registrando la fecha de una nueva visita de campo para poder capturar muestras.</p>
            <a href="{{ route('revisiones.create') }}" class="btn btn-secondary mt-2">Crear primera revisión</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
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
                        <td><span class="text-muted">#{{ $revision->id }}</span></td>
                        <td>
                                <span class="fw-bold text-dark" style="font-size: 1rem;">
                                    {{ \Carbon\Carbon::parse($revision->fecha_revision)->format('d/m/Y') }}
                                </span>
                        </td>
                        <td>
                                <span class="badge bg-no-aplicar">
                                    ID: {{ $revision->parcela_id }}
                                </span>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ $revision->parcela->direccion ?? 'Parcela no encontrada' }}
                            </small>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('revisiones.edit', $revision->id) }}"
                                   class="btn btn-secondary btn-sm"
                                   title="Editar fecha o parcela">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('revisiones.destroy', $revision->id) }}"
                                      method="POST"
                                      class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Eliminar revisión"
                                            onclick="return confirm('¿Está seguro de que desea eliminar esta revisión? Se borrarán todos los datos de laboratorio asociados a esta visita.')">
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
