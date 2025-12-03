@extends('layouts.app')

@section('title', 'Catálogo de Valores de Referencia')

@section('content')

    <div class="action-bar">
        <a href="{{ route('referencias.create') }}" class="btn btn-primary">
            <i class="fas fa-balance-scale"></i> Agregar Valor de Referencia
        </a>
    </div>

    @if ($referencias->isEmpty())
        <div class="empty-state">
            <p>No se han registrado valores de referencia aún.</p>
            <p>Necesitas establecer los valores ideales para cada nutriente antes de realizar análisis.</p>
        </div>
    @else
        <table class="data-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nutriente (Elemento)</th>
                <th>Valor de Referencia</th>
                <th>Coeficiente de Variación</th>
                <th>Unidad</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($referencias as $referencia)
                <tr>
                    <td>{{ $referencia->id }}</td>
                    <td>{{ $referencia->elemento->nombre ?? 'Elemento no encontrado' }}</td>
                    <td>{{ number_format($referencia->valor_referencia, 4) }}</td>
                    <td>{{ number_format($referencia->coef_variacion, 4) }}</td>
                    <td>{{ $referencia->elemento->unidad ?? 'N/A' }}</td>
                    <td class="actions">
                        <a href="{{ route('referencias.edit', $referencia->id) }}" class="btn btn-secondary btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('referencias.destroy', $referencia->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar la referencia (ID: {{ $referencia->id }})?')">
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
