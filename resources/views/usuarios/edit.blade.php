@extends('layouts.app')

@section('title', 'Editar Dueño: ' . $usuario->nombre)

@section('content')

    <div class="card-form">
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre"><i class="fas fa-id-card"></i> Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required>
                @error('nombre')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="telefono"><i class="fas fa-phone"></i> Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $usuario->telefono) }}" required>
                @error('telefono')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <hr style="border-top: 1px dashed #ccc; margin: 25px 0;">
            <p style="font-style: italic; color: #555;"><i class="fas fa-info-circle"></i> Deje los campos de contraseña vacíos si NO desea cambiarla.</p>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Nueva Contraseña:</label>
                <input type="password" id="password" name="password">
                @error('password')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation"><i class="fas fa-lock-open"></i> Confirmar Nueva Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> Actualizar Dueño</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
