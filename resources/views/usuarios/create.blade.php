@extends('layouts.app')

@section('title', 'Registrar Nuevo Dueño de Parcela')

@section('content')

    <div class="card-form">
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nombre"><i class="fas fa-id-card"></i> Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="telefono"><i class="fas fa-phone"></i> Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                @error('telefono')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Contraseña:</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation"><i class="fas fa-lock-open"></i> Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-user-check"></i> Registrar Dueño</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Cancelar</a>
            </div>
        </form>
    </div>

@endsection
