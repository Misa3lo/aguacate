@extends('layouts.app')

@section('title', 'Gestión de Parcelas Agrícolas')

@section('content')

    <div class="action-bar">
        <a href="{{ route('parcelas.create') }}" class="btn btn-primary">
            <i class="fas fa-map-marker-alt"></i> Registrar Nueva Parcela
        </a>
    </div>

    @if ($parcelas->isEmpty())
        <div class="empty-state">
            <p>No se han registrado parcelas aún.</p>
            <p>Comienza registrando una nueva parcela para iniciar el proceso de muestreo.</p>
        </div>
    @else
        <table class="data-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Dueño</th>
                <th>Dirección</th>
                <th>Extensión (ha)</th>
                <th>Árboles</th>
                <th>Coordenada GPS</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($parcelas as $parcela)
                <tr>
                    <td>{{ $parcela->id }}</td>
                    <td>{{ $parcela->usuario->nombre ?? 'N/A' }}</td>
                    <td>{{ $parcela->direccion }}</td>
                    <td>{{ number_format($parcela->extension_ha, 2) }}</td>
                    <td>{{ number_format($parcela->num_arboles) }}</td>
                    <td>{{ $parcela->coordenada_gps }}</td>
                    <td class="actions">
                        <a href="{{ route('parcelas.edit', $parcela->id) }}" class="btn btn-secondary btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('parcelas.destroy', $parcela->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar la parcela ID: {{ $parcela->id }}?')">
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
