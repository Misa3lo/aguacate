@extends('layouts.app')

@section('title', 'Gestión de Nutrientes')

@section('content')

    <div class="action-bar">
        <a href="{{ route('elementos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Agregar Nuevo Nutriente
        </a>
    </div>

    @if ($elementos->isEmpty())
        <div class="empty-state">
            <p>No se han registrado elementos (nutrientes) aún.</p>
            <p>Utiliza el botón para comenzar a crear el catálogo.</p>
        </div>
    @else
        <table class="data-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Unidad</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($elementos as $elemento)
                <tr>
                    <td>{{ $elemento->id }}</td>
                    <td>{{ $elemento->nombre }}</td>
                    <td>{{ $elemento->unidad }}</td>
                    <td class="actions">
                        <a href="{{ route('elementos.edit', $elemento->id) }}" class="btn btn-secondary btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('elementos.destroy', $elemento->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar el elemento {{ $elemento->nombre }}?')">
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
