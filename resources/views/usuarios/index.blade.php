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
                {{-- Fragmento de la tabla en index.blade.php --}}
                @foreach ($usuarios as $usuario)
                    <tr>
                        {{-- Cambio de $usuario->id a $usuario->Id --}}
                        <td><span class="text-muted">#{{ $usuario->Id }}</span></td>
                        {{-- Cambio de $usuario->nombre a $usuario->Name --}}
                        <td><strong>{{ $usuario->Name }}</strong></td>
                        {{-- Cambio de $usuario->telefono a $usuario->Phone --}}
                        <td>{{ $usuario->Phone }}</td>
                        {{-- En tu tabla de usuarios --}}
                        <td>
                            @if($usuario->Created_at)
                                {{-- Formato: 2026-03-15 14:30 --}}
                                {{ $usuario->Created_at->format('Y-m-d H:i:s') }}
                            @else
                                <span class="text-muted">No registrada</span>
                            @endif
                        </td>                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Uso de $usuario->Id para las rutas --}}
                                <a href="{{ route('usuarios.edit', $usuario->Id) }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('usuarios.destroy', $usuario->Id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Eliminar a {{ $usuario->Name }}?')">
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
