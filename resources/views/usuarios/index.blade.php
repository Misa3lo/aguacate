@extends('layouts.app')

@section('title', 'Gestión de Dueños de Parcelas')

@section('content')

    <div class="action-bar d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted m-0">Lista de productores registrados en el sistema KBI.</p>
        <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Agregar Nuevo Dueño
        </a>
    </div>

    @if ($usuarios->isEmpty())
        <div class="empty-state">
            <i class="fas fa-users-slash"></i>
            <h3>Sin registros</h3>
            <p>No se han registrado usuarios (dueños de parcelas) aún.</p>
            <a href="{{ route('usuarios.create') }}" class="btn btn-secondary mt-2">Registrar primer dueño</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th><i class="fas fa-user"></i> Nombre del Productor</th>
                    <th><i class="fas fa-phone"></i> Teléfono / Usuario</th>
                    <th><i class="fas fa-calendar-alt"></i> Fecha Registro</th>
                    <th style="width: 150px;" class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td><span class="text-muted">#{{ $usuario->id }}</span></td>
                        <td><span class="fw-bold text-dark">{{ $usuario->nombre }}</span></td>
                        <td>{{ $usuario->telefono }}</td>
                        <td>{{ $usuario->created_at?->format('d/m/Y') ?? 'N/A' }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                   class="btn btn-secondary btn-sm"
                                   title="Editar Información">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('usuarios.destroy', $usuario->id) }}"
                                      method="POST"
                                      class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Eliminar Registro"
                                            onclick="return confirm('¿Está seguro de que desea eliminar al usuario {{ $usuario->nombre }}? Esta acción no se puede deshacer.')">
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
