@extends('layouts.app')

@section('title', 'Registro de Revisiones de Parcelas')

@section('content')

    <div class="action-bar">
        <a href="{{ route('revisiones.create') }}" class="btn btn-primary">
            <i class="fas fa-calendar-plus"></i> Registrar Nueva Revisión
        </a>
    </div>

    @if ($revisiones->isEmpty())
        <div class="empty-state">
            <p>No se han registrado revisiones de parcelas aún.</p>
            <p>Comienza registrando la fecha de una nueva visita de campo.</p>
        </div>
    @else
        <table class="data-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Parcela ID</th>
                <th>Ubicación</th>
                <th>Fecha de Revisión</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($revisiones as $revision)
                <tr>
                    <td>{{ $revision->id }}</td>
                    <td>{{ $revision->parcela_id }}</td>
                    <td>{{ $revision->parcela->direccion ?? 'Parcela no encontrada' }}</td>
                    <td>{{ \Carbon\Carbon::parse($revision->fecha_revision)->format('d/m/Y') }}</td>
                    <td class="actions">
                        <a href="{{ route('revisiones.edit', $revision->id) }}" class="btn btn-secondary btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('revisiones.destroy', $revision->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar esta Revisión (ID: {{ $revision->id }})?')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
