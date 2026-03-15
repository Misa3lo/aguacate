@extends('layouts.app')

@section('title', 'Registrar Nuevo Dueño de Parcela')

@section('content')

    <div class="card-form">
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="Name"><i class="fas fa-id-card"></i> Nombre Completo:</label>
                {{-- name="Name" en lugar de "nombre" --}}
                <input type="text" id="Name" name="Name" value="{{ old('Name') }}" required>
                @error('Name') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="Phone"><i class="fas fa-phone"></i> Teléfono:</label>
                {{-- name="Phone" en lugar de "telefono" --}}
                <input type="text" id="Phone" name="Phone" value="{{ old('Phone') }}" required>
                @error('Phone') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="Password"><i class="fas fa-lock"></i> Contraseña:</label>
                {{-- name="Password" en lugar de "password" --}}
                <input type="password" id="Password" name="Password" required>
                @error('Password') <p class="error-message">{{ $message }}</p> @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-success">Registrar Dueño</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

@endsection
