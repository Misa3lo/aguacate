@extends('layouts.app')

@section('title', 'Gestión de Dueños de Parcelas')

@section('content')

    <div class="action-bar">
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Agregar Nuevo Dueño
        </a>
    </div>

    @if ($usuarios->isEmpty())
        <div class="empty-state">
            <p>No se han registrado usuarios (dueños de parcelas) aún.</p>
            <p>Utiliza el botón para comenzar.</p>
        </div>
    @else
        <table class="data-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Registrado Desde</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->telefono }}</td>
                    <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                    <td class="actions">
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-secondary btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar al usuario {{ $usuario->nombre }}?')">
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
