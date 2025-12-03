@extends('layouts.app')

@section('title', 'Registro de Muestras de Elementos por Parcela')

@section('content')

    <div class="action-bar">
        <a href="{{ route('muestreos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Ingresar Nueva Muestra
        </a>
    </div>

    @if ($muestreos->isEmpty())
        <div class="empty-state">
            <p>No se han registrado mediciones de muestras de nutrientes aún.</p>
            <p>Comienza a ingresar el valor observado de cada elemento por revisión.</p>
        </div>
    @else
        <table class="data-table">
            <thead>
            <tr>
                <th>ID Muestra</th>
                <th>Parcela</th>
                <th>Nutriente</th>
                <th>Revisión ID</th>
                <th>Fecha Revisión</th>
                <th>Valor Observado</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($muestreos as $muestreo)
                <tr>
                    <td>{{ $muestreo->id }}</td>
                    <td>ID: {{ $muestreo->parcela_id }} ({{ $muestreo->parcela->direccion ?? 'N/A' }})</td>
                    <td>{{ $muestreo->elemento->nombre ?? 'N/A' }} ({{ $muestreo->elemento->unidad ?? '' }})</td>
                    <td>{{ $muestreo->revision_id }}</td>
                    <td>{{ \Carbon\Carbon::parse($muestreo->revision->fecha_revision)->format('d/m/Y') ?? 'N/A' }}</td>
                    <td>{{ number_format($muestreo->valor_observado, 4) }}</td>
                    <td class="actions">
                        <a href="{{ route('muestreos.edit', $muestreo->id) }}" class="btn btn-secondary btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('muestreos.destroy', $muestreo->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar esta Muestra (ID: {{ $muestreo->id }})?')">
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
